<?php

namespace App\Models;

use App\Http\Controllers\ImageController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Image extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'path',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}