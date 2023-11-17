<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarCollection;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    private $messages;
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');

        $this->messages = [
            'driver_id.required' => 'Driver harus diisi',
            'driver_id.exists' => 'Driver tidak ditemukan',
            'driver_id.unique' => 'Driver sudah memiliki mobil',
            'type.required' => 'Tipe harus diisi',
            'capacity.required' => 'Kapasitas harus diisi',
            'capacity.integer' => 'Kapasitas harus berupa angka',
            'capacity.min' => 'Kapasitas minimal 1',
            'car_number.required' => 'Nomor mobil harus diisi',
            'car_number.string' => 'Nomor mobil harus berupa string',
            'car_number.max' => 'Nomor mobil maksimal 255 karakter',
            'car_number.unique' => 'Nomor mobil sudah digunakan',
            'plate_number.required' => 'Nomor plat harus diisi',
            'plate_number.string' => 'Nomor plat harus berupa string',
            'plate_number.max' => 'Nomor plat maksimal 255 karakter',
            'plate_number.unique' => 'Nomor plat sudah digunakan',
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpeg, png, jpg, gif, svg',
            'image.max' => 'Gambar maksimal 2048 KB',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('driver')->get();

        return ResponseFormatter::success(
            new CarCollection($cars),
            'Data list mobil berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:drivers,id|unique:cars,driver_id',
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
            'car_number' => 'required|string|max:255|unique:cars',
            'plate_number' => 'required|string|max:255|unique:cars',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Validation Error', 422);
        }

        $car = Car::create($request->validated());

        return ResponseFormatter::success(
            new CarResource($car),
            'Data mobil berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        if (!$car) {
            return ResponseFormatter::error([
                'error' => 'Data mobil tidak ditemukan',
            ], 'Data mobil tidak ditemukan', 404);
        }

        return ResponseFormatter::success(
            new CarResource($car),
            'Data mobil berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:drivers,id|unique:cars,driver_id,' . $car->id,
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
            'car_number' => 'required|string|max:255|unique:cars,car_number,' . $car->id,
            'plate_number' => 'required|string|max:255|unique:cars,plate_number,' . $car->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Validation Error', 422);
        }

        $car->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Car updated successfully',
            'data' => new CarResource($car),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Car deleted successfully',
        ]);
    }
}
