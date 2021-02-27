<?php

namespace App\Models;

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
            'is_liked_by_auth_user' => false,
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
            'is_liked_by_auth_user' => false,
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
    
}
