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
    private $messages;
    public function __construct()
    {
        $this->messages = [
            'car_id.required' => 'Mobil harus diisi',
            'car_id.exists' => 'Mobil tidak ditemukan',
            'route.required' => 'Rute harus diisi',
            'departure_time.required' => 'Waktu keberangkatan harus diisi',
            'departure_time.date_format' => 'Waktu keberangkatan tidak valid',
            'arrival_time.required' => 'Waktu kedatangan harus diisi',
            'arrival_time.date_format' => 'Waktu kedatangan tidak valid',
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
        if ($request->ajax()) {
            $schedules = Schedule::with('car.driver')->get();

            return DataTables::of($schedules)
                ->addColumn('driver_name', function ($schedule) {
                    return $schedule->car->driver->name;
                })
                ->addColumn('action', function ($schedule) {
                    return '
                        <div class="btn-group">
                            <a href="' . route('backend.schedules.edit', $schedule->id) . '"
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:;"
                                onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('backend.schedules.destroy', $schedule->id) . '\');"
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
                ->addColumn('departure_time', function ($schedule) {
                    return date('d-m-Y H:i', strtotime($schedule->departure_time));
                })
                ->addColumn('arrival_time', function ($schedule) {
                    return date('d-m-Y H:i', strtotime($schedule->arrival_time));
                })
                ->addColumn('price', function ($schedule) {
                    return 'Rp ' . number_format($schedule->price, 0, ',', '.');
                })
                ->rawColumns(['action', 'route', 'departure_time', 'arrival_time', 'price'])
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
        ], $this->messages);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $car = Car::find($request->car_id);
        $schedule = Schedule::create([
            'car_id' => $request->car_id,
            'route' => $request->route,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price,
        ]);

        if ($schedule) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan',
                'redirect' => route('backend.schedules.index'),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal ditambahkan',
            ]);
        }
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
        ], $this->messages);

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
