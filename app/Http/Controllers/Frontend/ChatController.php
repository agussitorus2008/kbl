<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('web')->user()->id;

        $chats = Chat::where(function ($query) use ($userId) {
            $query->where('sent_by', $userId)
                ->orWhere('sent_to', $userId);
        })->get();

        return response()->json($chats);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $userId = User::role('admin')->first()->id;

        $chat = Chat::create([
            'message' => $request->message,
            'sent_to' => $userId,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan berhasil dikirim',
        ]);
    }
}
