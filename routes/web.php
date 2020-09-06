<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetsController@index')->name('home');
    Route::post('/tweets', 'TweetsController@store');
    Route::post('/tweets/{tweet}/delete', 'TweetsController@delete')->name('tweet_delete');
    Route::post('/tweets/{tweet}/like', 'TweetLikesController@store');
    Route::post('/tweets/{tweet}/dislike', 'TweetDislikesController@store');

    Route::post(
        '/profiles/{user:username}/follow',
        'FollowsController@store'
    )->name('follow');

    Route::get(
        '/profiles/{user:username}/edit',
        'ProfilesController@edit'
    )->middleware('can:edit,user');

    Route::patch(
        '/profiles/{user:username}',
        'ProfilesController@update'
    )->middleware('can:edit,user');

    Route::get('/explore', 'ExploreController');
});

Route::get('/profiles/{user:username}', 'ProfilesController@show')->name(
    'profile'
);

Auth::routes();
