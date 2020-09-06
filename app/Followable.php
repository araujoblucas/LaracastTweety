<?php

namespace App;

use Illuminate\Filesystem\Cache;
trait Followable
{
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        $ok = $this->follows()->toggle($user);
        if($ok['attached']) {
            cache()->put('messageSuccess', 'Você está seguindo '.$user->username);
        } else {
            cache()->put('messageSuccess', 'Você deixou de seguir '.$user->username);
        }
    }

    public function following(User $user)
    {
        return $this->follows()
            ->where('following_user_id', $user->id)
            ->exists();
    }

    public function follows()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_user_id'
        );
    }
}
