<?php

namespace App\Http\Controllers\Api;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ScheduleCollection;

class ScheduleController extends Controller
{
    private $messages;
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');

        $this->messages = [
            'car_id.required' => 'Mobil harus diisi',
            'car_id.exists' => 'Mobil tidak ditemukan',
            'route.required' => 'Rute harus diisi',
            'departure_time.required' => 'Waktu keberangkatan harus diisi',
            'departure_time.date_format' => 'Waktu keberangkatan harus berupa tanggal dan waktu',
            'arrival_time.required' => 'Waktu kedatangan harus diisi',
            'arrival_time.date_format' => 'Waktu kedatangan harus berupa tanggal dan waktu',
            'price.required' => 'Harga harus diisi',
            'price.integer' => 'Harga harus berupa angka',
            'price.min' => 'Harga minimal 1',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // check if request not empty
        $schedules = Schedule::with('car.driver')
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
            ->get();

        return ResponseFormatter::success(
            new ScheduleCollection($schedules),
            'Data list jadwal berhasil diambil'
        );
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
        ], $this->messages);

        if ($validators->fails()) {
            return ResponseFormatter::error([
                'error' => $validators->errors(),
            ], 'Data jadwal gagal ditambahkan', 422);
        }

        $schedule = Schedule::create($request->validated());

        return ResponseFormatter::success(
            new ScheduleResource($schedule),
            'Data jadwal berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return ResponseFormatter::success(
            new ScheduleResource($schedule),
            'Data jadwal berhasil diambil'
        );
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
        ], $this->messages);

        if ($validators->fails()) {
            return ResponseFormatter::error([
                'error' => $validators->errors(),
            ], 'Data jadwal gagal diubah', 422);
        }

        $schedule->update($request->validated());

        return ResponseFormatter::success(
            new ScheduleResource($schedule),
            'Data jadwal berhasil diubah'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return ResponseFormatter::success(
            null,
            'Data jadwal berhasil dihapus'
        );
    }
}
