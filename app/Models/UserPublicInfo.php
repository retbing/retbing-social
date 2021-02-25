<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPublicInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'username',
        'bio',
        'image'
    ];

    public function smallDetails()
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'username' => $this->username,
            'is_followed_by_auth_user' => Follow::isFollowedByAuthenticatedUser($this->user_id),
            'image' => [
                'id' => $this->image->id,
                'path' => $this->image->path,
                'nsfw_ratio' => $this->image->nsfw_ratio
            ],
        ];
    }

    public function fullDetails()
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'username' => $this->username,
            'bio' => $this->bio,
            'joined_at' => $this->created_at,
            'is_followed_by_auth_user' => Follow::isFollowedByAuthenticatedUser($this->id),
            'activity' => [
                'following_count' => $this->activity->following_count,
                'follower_count' => $this->activity->follower_count,
                'posts_count' => $this->activity->posts_count,
            ],
            'image' => [
                'id' => $this->image->id,
                'path' => $this->image->path,
                'updated_at' => $this->image->updated_at,
                'nsfw_ratio' => $this->image->nsfw_ratio
            ],
        ];
    }




    /**
     * Relations
     */

    public function activity()
    {
        return $this->hasOne(UserActivity::class, 'user_pub_id', 'id');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable', 'imageable_type', 'imageable_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'following_id', 'id');
    }
}