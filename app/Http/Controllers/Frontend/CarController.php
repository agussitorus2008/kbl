<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $busCount = Car::where('type', 'bus')->count();
        $minibusCount = Car::where('type', 'minibus')->count();
        $carCount = Car::where('type', 'car')->count();

        if ($request->ajax()) {
            $type = $request->type;
            $collection = Car::where('type', $type)->paginate(10);
            return view('pages.frontend.car.list', compact('collection', 'type'));
        }

        return view('pages.frontend.car.index', compact('busCount', 'minibusCount', 'carCount'));
    }

    public function detail()
    {
        return view('pages.frontend.car.show');
    }
}
