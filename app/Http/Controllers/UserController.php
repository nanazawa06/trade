<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showUser(User $user)
    {
        return view('users.user_profile')->with([
            'user' => $user,
            'posts' => $user->getUserPosts(),
            'review_score' => $user->averageScore(),
            ]);
    }
}
