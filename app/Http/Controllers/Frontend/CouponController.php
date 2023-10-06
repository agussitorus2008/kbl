<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keyword = $request->keyword;
            $coupons = Coupon::where('user_id', Auth::user()->id)
                ->where(function ($query) use ($keyword) {
                    $query->where('code', 'like', '%' . $keyword . '%')
                        ->orWhere('limit', 'like', '%' . $keyword . '%')
                        ->orWhere('used', 'like', '%' . $keyword . '%')
                        ->orWhere('discount', 'like', '%' . $keyword . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(10);

            return view('pages.backend.coupon.list', compact('coupons'));
        }
        return view('pages.backend.coupon.index');
    }
}
