<?php

namespace App\Http\Controllers;

use App\Events\MessageDeleted;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;


class ChatsController extends Controller
{
    //Add the below functions
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        broadcast(new MessageDeleted($message))->toOthers();
        $message->delete();

        return response()->json(['message' => 'Message supprimé avec succès']);
    }
}
