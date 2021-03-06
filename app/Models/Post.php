<?php

namespace App\Models;

use App\Http\Controllers\LikeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function specificInfo()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'is_liked_by_auth_user' => LikeController::isLikedByAuth($this->id),
            'image' =>  [
                'path' => $this->image->path
            ],
            'user' => [
                'id' => $this->user->user_public_info->id,
                'name' => $this->user->user_public_info->name,
                'image' => [
                    'path' => $this->user->user_public_info->image->path
                ]
            ],
            'activity' => [
                'likes_count' => $this->post_activity->likes_count,
                'comments_count' => $this->post_activity->comments_count
            ]

        ];
    }
    public function detailedInfo()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_liked_by_auth_user' => LikeController::isLikedByAuth($this->id),
            'image' => [
                'path' => $this->user->user_public_info->image->path
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->user_public_info->name,
                'username' => $this->user->user_public_info->username,
                'image' => [
                    'path' => $this->user->user_public_info->image->path
                ]
            ],
            'activity' => [
                'likes_count' => $this->post_activity->likes_count,
                'comments_count' => $this->post_activity->comments_count
            ]
        ];
    }

    /**
     * Relationship getter functions 
     */
    public function post_activity()
    {
        return $this->hasOne(PostActivity::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable', 'imageable_type', 'imageable_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    
    
}
