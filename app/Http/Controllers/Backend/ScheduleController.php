<?php

namespace App\Http\Controllers\Backend;

use App\Models\Car;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $schedules = Schedule::with('car.driver')->get();

            return DataTables::of($schedules)
                ->addColumn('driver_name', function ($schedule) {
                    return $schedule->car->driver->name;
                })
                ->addColumn('action', function ($schedule) {
                    $editRoute = route('backend.schedule.edit', $schedule->id);
                    $deleteRoute = route('backend.schedule.destroy', $schedule->id);

                    return '
                        <div class="btn-group">
                            <a href="javascript:;" onclick="load_input(\'' . $editRoute . '\');"
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:;"
                                onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . $deleteRoute . '\');"
                                class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        ';
                })
                ->addColumn('route', function ($schedule) {
                    $routeMap = [
                        'ML' => 'Medan-Laguboti',
                        'LM' => 'Laguboti-Medan',
                        'SL' => 'Sibolga-Laguboti',
                        'LS' => 'Laguboti-Sibolga',
                    ];

                    return $routeMap[$schedule->route] ?? '';
                })
                ->rawColumns(['action', 'route'])
                ->make(true);
        }

        return view('pages.backend.schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::with('driver')->get();
        return view('pages.backend.schedule.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validators = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'route' => 'required',
            'departure_time' => 'required|date_format:Y-m-d H:i:s',
            'arrival_time' => 'required|date_format:Y-m-d H:i:s',
            'price' => 'required|integer|min:1',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $car = Car::find($request->car_id);

        Schedule::create([
            'car_id' => $request->car_id,
            'route' => $request->route,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price,
            'available_seats' => $car->capacity,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $cars = Car::with('driver')->get();
        return view('pages.backend.schedule.edit', compact('schedule', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validators = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'route' => 'required',
            'departure_time' => 'required|date_format:Y-m-d H:i:s',
            'arrival_time' => 'required|date_format:Y-m-d H:i:s',
            'price' => 'required|integer|min:1',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $car = Car::find($request->car_id);

        $schedule->update([
            'car_id' => $request->car_id,
            'route' => $request->route,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price,
            'available_seats' => $car->capacity,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
