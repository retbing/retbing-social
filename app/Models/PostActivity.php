<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostActivity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function increaseLikes()
    {
        $likes = $this->likes_count + 1;
        $this->likes_count = $likes;
        $this->save();
    }


    public function decreaseLikes()
    {
        $likes = $this->likes_count > 0 ? $this->likes_count - 1 : 0;
        $this->likes_count = $likes;
        $this->save();
    }
}
