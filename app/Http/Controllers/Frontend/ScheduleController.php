<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $carTypes = ['bus', 'minibus', 'car'];

        $counts = [];
        foreach ($carTypes as $carType) {
            $counts[$carType] = Schedule::where('departure_time', '>=', $now)
                ->whereHas('car', function ($query) use ($carType) {
                    $query->where('type', $carType);
                })
                ->count();
        }

        if ($request->all() != NULL) {
            $route = $request->route;
            $departureTime = $request->departure_time;
            $availableSeats = $request->available_seats;
        } else {
            $route = '';
            $departureTime = '';
            $availableSeats = '';
        }

        $max = Schedule::max('price');
        $min = Schedule::min('price');

        if ($request->ajax()) {
            // check if request not empty
            $collection = Schedule::with('car.driver')
                ->where(function ($query) use ($request) {
                    $query->whereHas('car', function ($subQuery) use ($request) {
                        $subQuery->where('type', 'like', '%' . $request->car_type . '%');
                    });
                })
                ->when($request->route, function ($query) use ($request) {
                    return $query->where('route', 'like', '%' . $request->route . '%');
                })
                ->when($request->price_start && $request->price_end, function ($query) use ($request) {
                    return $query->whereBetween('price', [$request->price_start, $request->price_end]);
                })
                ->when($request->depart_time_start && $request->depart_time_end, function ($query) use ($request) {
                    return $query->whereTime('departure_time', '>=', $request->depart_time_start)
                        ->whereTime('departure_time', '<=', $request->depart_time_end);
                })
                ->when($request->available_seats, function ($query) use ($request) {
                    return $query->where('available_seats', '>=', $request->available_seats);
                })
                ->paginate(9);

            return view('pages.frontend.schedule.list', compact('collection', 'route'));
        }

        return view('pages.frontend.schedule.index', compact('max', 'min', 'route', 'departureTime', 'availableSeats',  'carTypes', 'counts'));
    }


    public function seats(Schedule $schedule)
    {
        $orders = $schedule->orders()->where('status', 'booked')->with('orderDetails')->get();
        $orders_details = $orders->map(function ($order) {
            return $order->orderDetails;
        })->flatten();
        $mark = 'e';
        $seats = [];
        $selected = [];

        // Function to calculate seats based on car type
        function calculateSeats($carCapacity, $rows, $mark, $closed)
        {
            $seats = [];
            for ($i = 1; $i <= $rows; $i++) {
                $seat = '';
                for ($j = 1; $j <= $carCapacity; $j++) {
                    if ($i == 1 && $j == $closed) {
                        $seat .= '_';
                    } else {
                        $seat .= $mark;
                    }
                }
                array_push($seats, $seat);
            }
            return $seats;
        }

        // Calculate seats based on car type
        $row = round($schedule->car->capacity / 3);
        $seats = calculateSeats(3, $row, $mark, 3);

        // Collect selected seats in a single pass
        foreach ($orders_details as $order_detail) {
            $seat = $order_detail->seat_id;
            $selected[] = $seat;
        }

        $price = $schedule->price;

        return response()->json([
            'map' => $seats,
            'selected' => $selected,
            'price' => $price
        ]);
    }

    public function create(Schedule $schedule)
    {
        return view('pages.frontend.schedule.create', ['data' => $schedule]);
    }

    public function confirm(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'seats' => 'required',
        ]);

        if ($validators->fails()) {
            $errors = $validators->errors();
            return response()->json([
                'alert' => 'error',
                'message' => $errors->first(),
            ]);
        }

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show(Schedule $schedule)
    {
        return view('pages.frontend.schedule.show', compact('schedule'));
    }
}
