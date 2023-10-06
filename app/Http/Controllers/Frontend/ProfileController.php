<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        return view('pages.frontend.profile.index');
    }

    public function update_profile(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255|unique:users,phone,' . Auth::user()->id,
            'address' => 'required|max:255',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile berhasil diperbarui',
        ]);
    }

    public function cpassword()
    {
        return view('pages.frontend.profile.password');
    }

    public function do_cpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->current_password, $user->password)) {
            if (Hash::check($request->new_password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password tidak boleh sama dengan password lama',
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password berhasil diubah',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Password lama tidak sesuai',
            ]);
        }
    }
}
