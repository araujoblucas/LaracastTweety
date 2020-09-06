<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Filesystem\Cache;


class TweetsController extends Controller
{
    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()
                ->user()
                ->timeline(),
        ]);
    }
    public function getImageTweetAttribute($value)
    {
        return asset($value);
    }
    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'imageTweet' => 'image'
        ]);


        if(request('imageTweet')) {
            $attributes['imageTweet'] = request('imageTweet')->store('tweet_image');
            $test = Tweet::create([
                'user_id' => auth()->id(),
                'body' => $attributes['body'],
                'imageTweet' => $attributes['imageTweet']
            ]);
        } else {
            $test =Tweet::create([
                'user_id' => auth()->id(),
                'body' => $attributes['body'],
            ]);
        }
        if ($test)
            cache()->put('messageSuccess', 'Sucesso ao inserir o tweet');
        else
            cache()->put('messageError', 'Erro ao inserir o tweet');

        return redirect()->route('home');
    }

    public function delete(Tweet $tweet)
    {
        if( $tweet->user_id == current_user()->id ) {
            $test = Tweet::findorfail($tweet->id)->delete();
        }

        if ($test)
            cache()->put('messageSuccess', 'Sucesso ao apagar o tweet');
        else
            cache()->put('messageError', 'Erro ao apagar o tweet');


        return back();

    }

}
