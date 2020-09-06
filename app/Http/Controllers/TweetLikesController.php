<?php

namespace App\Http\Controllers;

use App\Tweet;

class TweetLikesController extends Controller
{
    public function store(Tweet $tweet)
    {
        $tweet->like(current_user(), $tweet);

        return back();
    }

}
