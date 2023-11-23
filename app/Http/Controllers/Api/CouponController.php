<?php

namespace App\Http\Controllers\Api;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use App\Http\Resources\CouponCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    private $messages;
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');

        $this->messages = [
            'user_id.required' => 'Nama harus diisi',
            'user_id.exists' => 'Nama tidak ditemukan',
            'discount.required' => 'Diskon harus diisi',
            'discount.integer' => 'Diskon harus berupa angka',
            'discount.min' => 'Diskon minimal 1',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if auth and is admin, get all coupons, else get coupons of the authenticated user
        $coupons = Auth::check() && Auth::user()->hasRole('admin')
            ? Coupon::with('user')->get()
            : Coupon::where('user_id', Auth::id())->get();

        return ResponseFormatter::success(
            new CouponCollection($coupons),
            'Data list coupon berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'discount' => 'required|integer|min:1',
        ], $this->messages);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Data gagal ditambahkan', 422);
        }

        $coupon = Coupon::create($request->all());

        return ResponseFormatter::success(
            new CouponResource($coupon),
            'Data coupon berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        if (!$coupon) {
            return ResponseFormatter::error(
                null,
                'Data coupon tidak ditemukan',
                404
            );
        }

        return ResponseFormatter::success(
            new CouponResource($coupon),
            'Data coupon berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id' . ($coupon->user_id == $request->user_id ? '' : '|unique:coupons,user_id'),
            'discount' => 'required|integer|min:1',
        ], $this->messages);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Data gagal diupdate', 422);
        }

        $coupon->update($request->all());

        return ResponseFormatter::success(
            new CouponResource($coupon),
            'Data coupon berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return ResponseFormatter::success(
            null,
            'Data coupon berhasil dihapus'
        );
    }
}
