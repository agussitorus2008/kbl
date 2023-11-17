<?php

namespace App\Http\Controllers\Api;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Http\Resources\DriverCollection;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    private $messages;
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');

        $this->messages = [
            'name.required' => 'Nama harus diisi',
            'phone.required' => 'Nomor telepon harus diisi',
            'phone.numeric' => 'Nomor telepon harus berupa angka',
            'phone.unique' => 'Nomor telepon sudah digunakan',
            'address.required' => 'Alamat harus diisi',
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
        $drivers = Driver::all();

        return ResponseFormatter::success(
            new DriverCollection($drivers),
            'Data list driver berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:drivers',
            'address' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $this->messages);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Validation Error', 422);
        }

        $driver = Driver::create($request->validated());

        return ResponseFormatter::success(
            new DriverResource($driver),
            'Data driver berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        if (!$driver) {
            return ResponseFormatter::error(
                null,
                'Data driver tidak ditemukan',
                404
            );
        }

        // dd($driver);

        return ResponseFormatter::success(
            new DriverResource($driver),
            'Data driver berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:drivers',
            'address' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $this->messages);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Validation Error', 422);
        }

        $driver->update($request->all());

        return ResponseFormatter::success(
            new DriverResource($driver),
            'Data driver berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return ResponseFormatter::success(
            null,
            'Data driver berhasil dihapus'
        );
    }
}
