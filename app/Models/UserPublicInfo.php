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

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable', 'imageable_type', 'imageable_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}