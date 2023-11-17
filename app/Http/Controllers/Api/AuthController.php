<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Validation Error', 422);
        }

        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return ResponseFormatter::error(['message' => 'Unauthorized'], 'Authentication Failed', 401);
        }

        $user = User::where('email', $request->email)->first();

        return ResponseFormatter::success([
            'token' => $user->createToken('authToken')->plainTextToken,
            'user' => new UserResource($user),
        ], 'Authenticated');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:15', 'min:10'],
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Validation Error', 422);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('customer');

        return ResponseFormatter::success([
            'token' => $user->createToken('authToken')->plainTextToken,
            'user' => new UserResource($user),
        ], 'User registered');
    }

    public function logout()
    {
        $user = User::find(auth()->user()->id);

        $user->tokens()->delete();

        return ResponseFormatter::success(null, 'Logged out');
    }
}
