<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages_index($project_id)
    {
        return Message::with('user')->where('project_id', $project_id)->orderBy('created_at', 'desc')->get();
    }

    public function messages_store(Request $request)
    {
        $data = request()->all();
        $message = new Message();
        $message->user_id = $data['user_id'];
        $message->project_id = $data['project_id'];
        $message->message = $data['message'];
        $message->save();
    }
}
