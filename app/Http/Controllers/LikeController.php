<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function indexLikes()
    {
        $user_id = Auth::id();
        $like_posts = User::find($user_id)
        ->likes
        ->transform(function($item){return $item->post;})
        ->filter(function ($value){return $value->status == 'trading';});
        
        return view('users.likes_posts')->with(['posts' => $like_posts]);
    }
}
