<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function indexReviews()
    {
        return view('users.reviews_list');
    }
}
