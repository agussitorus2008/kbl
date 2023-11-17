<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Http\Resources\ChatCollection;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewChatNotification;

class ChatController extends Controller
{
    private $messages;

    public function __construct()
    {
        $this->messages = [
            'sent_to.required' => 'Penerima harus diisi',
            'sent_to.exists' => 'Penerima tidak ditemukan',
            'message.required' => 'Pesan harus diisi',
        ];
    }

    public function index(Request $request)
    {
        $role = auth()->user()->hasRole('admin') ? 'customer' : 'admin';

        $users = User::role($role)->get();

        return ResponseFormatter::success(
            new UserCollection($users),
            'Data list chat berhasil diambil'
        );
    }

    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'sent_to' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ], $this->messages);

        if ($validators->fails()) {
            return ResponseFormatter::error(
                ['error' => $validators->errors()],
                'Data gagal ditambahkan',
                422
            );
        }

        $chat = new Chat([
            'sent_to' => $request->sent_to,
            'message' => $request->message,
            'parent_id' => $this->findParentChatId($request->sent_to),
        ]);
        $chat->save();

        $time = $chat->created_at->diffForHumans();

        $user = User::find($request->sent_to);
        $user->notify(new NewChatNotification($chat, $time));

        return ResponseFormatter::success(
            new ChatResource($chat),
            'Data chat berhasil ditambahkan'
        );
    }

    public function show(User $user)
    {
        if (!$user) {
            return ResponseFormatter::error(
                null,
                'Data chat tidak ditemukan',
                404
            );
        }

        $authUserId = auth()->user()->id;

        $chats = Chat::whereIn('sent_by', [$authUserId, $user->id])
            ->whereIn('sent_to', [$authUserId, $user->id])
            ->get();

        return ResponseFormatter::success(
            new ChatCollection($chats),
            'Data chat berhasil diambil'
        );
    }
}
