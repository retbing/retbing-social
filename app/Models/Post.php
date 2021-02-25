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
            'user_id' => $this->user_id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'is_followed_by_auth_user' => false,
            'image' => [
                'id' => $this->image->id,
                'path' => $this->image->path,
                'nsfw_ratio' => $this->image->nsfw_ratio
            ],
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
