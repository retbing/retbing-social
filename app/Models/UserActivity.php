<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_count',
        'following_count',
        'posts_count'
    ];

    public function increaseFollowers()
    {
        $follower_count = $this->follower_count +1;
        $this->follower_count = $follower_count;
        $this->save();
    }


    public function increaseFollowings()
    {
        $following_count = $this->following_count +1;
        $this->following_count = $following_count;
        $this->save();
    }

    public function decreaseFollowers()
    {
        $follower_count = $this->follower_count - 1;
        $this->follower_count = $follower_count;
        $this->save();
    }


    public function decreaseFollowings()
    {
        $following_count = $this->following_count - 1;
        $this->following_count = $following_count;
        $this->save();
    }

    public function increasePosts()
    {
        $posts_count = $this->posts_count + 1;
        $this->posts_count = $posts_count;
        $this->save();
    }


    public function decresePosts()
    {
        $posts_count = $this->posts_count - 1;
        $this->posts_count = $posts_count;
        $this->save();
    }


    /**
     * Relations
     */
    public function user_public_info()
    {
        return $this->belongsTo(UserPublicInfo::class, 'user_id', 'user_id');
    }
}