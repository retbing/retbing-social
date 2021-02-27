<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'follower_id'
    ];

    public function follower_user()
    {
        return $this->belongsTo(UserPublicInfo::class, 'follower_id', 'id');
    }

    public function follower_image()
    {
        return $this->hasOneThrough(Image::class, UserPublicInfo::class, 'id', 'imageable_id', 'follower_id');
    }


    public function following_user()
    {
        return $this->belongsTo(UserPublicInfo::class, 'following_id', 'id');
    }

    public function following_image()
    {
        return $this->hasOneThrough(Image::class, UserPublicInfo::class, 'id', 'imageable_id', 'following_id');
    }


    public static function isFollowedByAuthenticatedUser($followedId)
    {
        $user = auth('api')->user();
        if ($user != null) {
            return  count(Follow::where('follower_id', $user->id)->where('following_id', $followedId)->get()) > 0;
        } else {
            return false;
        }
    }
}