<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function do_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ], [
            'email.exists' => 'Email tidak terdaftar',
            'email.email' => 'Email tidak valid',
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Masuk',
                'redirect' => Auth::user()->hasRole('admin') ? route('backend.dashboard') : 'refresh',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Password anda salah',
            ]);
        }
    }

    public function do_register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/|unique:users',
            'phone' => 'required|numeric|digits_between:10,12|unique:users',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'email.regex' => 'Email tidak valid',
            'phone.required' => 'Nomor telepon tidak boleh kosong',
            'phone.numeric' => 'Nomor telepon harus berupa angka',
            'phone.digits_between' => 'Nomor telepon minimal 10 dan maksimal 12 angka',
            'phone.unique' => 'Nomor telepon sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone'  => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->save();
        $user->assignRole('customer');

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mendaftar',
            'redirect' => route('home'),
        ]);
    }

    public function do_logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
