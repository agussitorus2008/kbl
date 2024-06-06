<?php

namespace App\Http\Controllers\Backend;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // get all users except the admin
            $users = User::role('customer')->where('name', 'like', '%' . $request->keyword . '%')->get();
            return view('pages.backend.chat.list', compact('users'));
        }
        return view('pages.backend.chat.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'message' => 'required|string|max:255',
        ], $this->messages);

        // Create a new chat message
        $chat = new Chat([
            'sent_to' => $request->sent_to,
            'message' => $request->message,
        ]);
        $chat->parent_id = $this->findParentChatId($request->sent_to);
        $chat->save();

        // Get the time difference for display
        $time = $chat->created_at->diffForHumans();

        // Notify the user about the new chat message
        $user = User::find($request->sent_to);
        $user->notify(new NewChatNotification($request->message));

        return response()->json([
            'status' => 'success',
            'message' => 'Pesan berhasil dikirim',
            'content' => $request->message,
            'time' => $time,
        ]);
    }

    private function findParentChatId($sentTo)
    {
        $chats = Chat::where('sent_by', $sentTo)->orWhere('sent_to', $sentTo)->first();

        return $chats ? $chats->id : null;
    }


    public function show($id)
    {
        $user = User::find($id);

        // Get Conversation
        $chats = Chat::where('sent_by', $id)->orWhere('sent_to', $id)->first();

        if ($chats && $chats->parent_id !== null) {
            $chats = Chat::where('parent_id', $chats->parent_id)->get();
        }

        return view('pages.backend.chat.detail', compact('chats', 'user'));
    }
}
