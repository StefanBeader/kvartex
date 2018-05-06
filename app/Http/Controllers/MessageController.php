<?php

namespace App\Http\Controllers;

use App\Grids\MessagesGrid;
use App\Models\MessageReplay;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('user_id', Auth::user()->id)->get();
        $messageReplays = MessageReplay::where('user_id', Auth::user()->id)->get();

        return view('messages.index', compact('messages', 'messageReplays'));
    }

    public function dashboardUserMessages(Request $request)
    {
        $user_id = $request->user_id;
        $messages = Message::where('user_id', $user_id)->get();
        Message::setMessagesAsRead($messages->pluck('id'));
        $messageReplays = MessageReplay::where('user_id', $user_id)->get();


        return view('messages.dashboardUserMessages', compact('messages', 'messageReplays', 'user_id'));
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();

        $message->user_id = Auth::user()->id;
        $message->body = $request->body;
        $message->save();

        return redirect('/messages');
    }

    public function sendMessageReplay(Request $request)
    {
        $message = new MessageReplay();

        $message->user_id = $request->user_id;
        $message->body = $request->body;
        $message->save();

        return redirect('/dashboardUserMessages?user_id=' . $request->user_id);
    }

    public function dashboardMessages()
    {
        $messagesGrid = MessagesGrid::create();
        return view('messages.dashboardMessages', compact('messagesGrid'));
    }

    public function getNewMessagesFromUser(Request $request)
    {
        return [
            'message' => 'success',
            'data' => Message::where('user_id', $request->user_id)->where('isRead', false)->get()
        ];
    }
}
