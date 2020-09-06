<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function scopeWithDislikes(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(disliked) dislikes from dislikes group by tweet_id',
            'dislikes',
            'dislikes.tweet_id',
            'tweets.id'
        );
    }

    public function isLikedBy(User $user)
    {
        return (bool) $user->likes
            ->where('tweet_id', $this->id)
            ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->dislikes
            ->where('tweet_id', $this->id)
            ->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function dislike($user = null, $tweet)
    {
        $like = $this->dislikes()
            ->where('tweet_id', '=', $tweet->id)
            ->where('user_id', current_user()->id)
            ->first();
        if ( $like ) {
            $like->delete();
        }
        else {
            $this->dislikes()->create(
                [
                    'user_id' => $user ? $user->id : auth()->id(),
                    'disliked' => 1
                ]
            );
            $this->likes()
                ->where('tweet_id', '=', $tweet->id)
                ->where('user_id', current_user()->id)
                ->delete();
        }
    }

    public function like($user = null, $tweet)
    {
        $like = $this->likes()
            ->where('tweet_id', '=', $tweet->id)
            ->where('user_id', current_user()->id)
            ->first();
        if ( $like ) {
            $like->delete();
        }
        else {
            $this->likes()->create(
                [
                    'user_id' => $user ? $user->id : auth()->id(),
                    'liked' => 1
                ]
            );
            $this->dislikes()
                ->where('tweet_id', '=', $tweet->id)
                ->where('user_id', current_user()->id)
                ->delete();
        }
    }
}
