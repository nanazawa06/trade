<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Events\ProposalMessage;
use App\Models\Post;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function sendMessage(Request $request, Post $post)
    {
        $message = $request->message;
        $profile_icon = Auth::user()->profile_icon;
        $user_id = Auth::id();
        $chat = $post->chats()->create([
                    'user_id' => $user_id,
                    'message' => $message,
                ]);
        
        broadcast(new MessageSent($chat))->toOthers();
        $param = [
            'user_id' => $user_id,
            'profile_icon' => $profile_icon,
            'message' => $message
            ];
        return response()->json($param);
    }
    
    public function messageToProposal(Request $request, Proposal $proposal)
    {
        $message = $request->message;
        $profile_icon = Auth::user()->profile_icon;
        $user_id = Auth::id();
        $chat = $proposal->chats()->create([
                    'user_id' => $user_id,
                    'message' => $message,
                ]);
        
        broadcast(new ProposalMessage($proposal))->toOthers();
        $param = [
            'user_id' => $user_id,
            'profile_icon' => $profile_icon,
            'message' => $message
            ];
        return response()->json($param);
    }
    
}
