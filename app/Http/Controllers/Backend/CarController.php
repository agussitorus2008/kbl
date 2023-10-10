<?php

namespace App\Http\Controllers\Backend;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cars = Car::with('driver')
                ->get();
            return DataTables::of($cars)
                ->addColumn('driver_name', function ($cars) {
                    return $cars->driver->name;
                })
                ->addColumn('action', function ($cars) {
                    return '
                    <div class="btn-group" role="group">
                    <a href="javascript:;" onclick="load_input(\'' . route('backend.car.edit', $cars->id) . '\');" class="btn btn-sm btn-warning">
                        <i class="fas fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('backend.car.destroy', $cars->id) . '\');" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.backend.car.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = Driver::all();
        return view('pages.backend.car.create', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'driver_id' => 'required|exists:drivers,id|unique:cars,driver_id',
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
            'car_number' => 'required|string|max:255|unique:cars',
            'plate_number' => 'required|string|max:255|unique:cars',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $image = $request->file('image');
        $image_name = time() . '.' . $image->extension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        if (!file_exists(public_path('images/cars'))) {
            mkdir(public_path('images/cars'), 0777, true);
        }
        $image_resize->save(public_path('images/cars/' . $image_name));

        $car = Car::create([
            'driver_id' => $request->driver_id,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'car_number' => $request->car_number,
            'plate_number' => $request->plate_number,
            'image' => $image_name,
        ]);

        if ($car) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan',
                'redirect' => route('backend.car.index'),
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
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $drivers = Driver::all();
        return view('pages.backend.car.edit', compact('car', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validators = Validator::make($request->all(), [
            'driver_id' => 'required|exists:drivers,id|unique:cars,driver_id,' . $car->id,
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
            'car_number' => 'required|string|max:255|unique:cars,car_number,' . $car->id,
            'plate_number' => 'required|string|max:255|unique:cars,plate_number,' . $car->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        if ($request->hasFile('image')) {
            if (file_exists(public_path('images/cars/' . $car->image))) {
                unlink(public_path('images/cars/' . $car->image));
            }
            $image = $request->file('image');
            $image_name = time() . '.' . $image->extension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            if (!file_exists(public_path('images/cars'))) {
                mkdir(public_path('images/cars'), 0777, true);
            }
            $image_resize->save(public_path('images/cars/' . $image_name));
        }

        $car->driver_id = $request->driver_id;
        $car->type = $request->type;
        $car->capacity = $request->capacity;
        $car->car_number = $request->car_number;
        $car->plate_number = $request->plate_number;
        $car->save();

        if ($car) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah',
                'redirect' => route('backend.car.index'),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal diubah',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if (file_exists(public_path('images/cars/' . $car->image))) {
            unlink(public_path('images/cars/' . $car->image));
        }
        $car->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
