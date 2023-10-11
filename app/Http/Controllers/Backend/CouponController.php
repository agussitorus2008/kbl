<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    private $messages;
    public function __construct()
    {
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $coupons = Coupon::with('user')
                ->get();
            return DataTables::of($coupons)
                ->addColumn('user_name', function ($coupon) {
                    return $coupon->user->name;
                })
                ->addColumn('action', function ($coupon) {
                    return '<div class="btn-group" role="group">
                    <a href="' . route('backend.coupons.edit', $coupon->id) . '" class="btn btn-sm btn-warning">
                        <i class="fas fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('backend.coupons.destroy', $coupon->id) . '\');" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>';
                })
                ->addColumn('used', function ($coupon) {
                    if ($coupon->used == 1) {
                        return '<span class="badge badge-success">Sudah Digunakan</span>';
                    } else {
                        return '<span class="badge badge-danger">Belum Digunakan</span>';
                    }
                })
                ->rawColumns(['action', 'used'])
                ->make(true);
        }
        return view('pages.backend.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = User::role('customer')
            ->withCount('orders')
            ->whereHas('orders', function ($query) {
                $query->has('orderDetails', '>=', 5);
            })
            ->get(['id', 'name']);


        return view('pages.backend.coupon.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'discount' => 'required|integer|min:1',
        ], $this->messages);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $coupon = Coupon::create([
            'user_id' => $request->user_id,
            'discount' => $request->discount,
        ]);

        if ($coupon) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kupon berhasil ditambahkan',
                'redirect' => route('backend.coupons.index')
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Kupon gagal ditambahkan',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('pages.backend.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validators = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'discount' => 'required|integer|min:1',
        ], $this->messages);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $coupon->update([
            'user_id' => $request->user_id,
            'discount' => $request->discount,
        ]);

        if ($coupon) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kupon berhasil diubah',
                'redirect' => route('backend.coupons.index')
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Kupon gagal diubah',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        if ($coupon) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kupon berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Kupon gagal dihapus',
            ]);
        }
    }
}
