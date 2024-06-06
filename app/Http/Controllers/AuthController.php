<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('pages.auth.login');
        } else {
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
                    'redirect' => Auth::user()->hasRole('admin') ? route('backend.dashboard') : '',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email atau password salah',
                ]);
            }
        }
    }

    public function register(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('pages.auth.register');
        } else {
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
    }

    public function forgot(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('pages.auth.forgot');
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:dns|exists:users,email',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first(),
                ]);
            }
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Link reset password telah dikirim ke email anda',
                    'redirect' => route('login'),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan, silahkan coba lagi',
                ]);
            }
        }
    }

    public function reset($token, Request $request)
    {
        $email = $request->email;
        return view('pages.auth.reset', compact('token', 'email'));
    }

    public function do_reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email:dns|exists:users,email',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
            'toc' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 'error',
                'message' => $errors->first(),
            ]);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'confirm_password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password berhasil diubah',
                'redirect' => route('password.change'),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan, silahkan coba lagi',
            ]);
        }
    }

    public function do_logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
