<?php

namespace App\Services;

use \Illuminate\Http\UploadedFile;
use \Illuminate\Support\Str;

abstract class Upload
{
    public const DEFAULT_AVATAR_PATH = 'public\storage\avatars\default-avatar-image.png';
    public const DEFAULT_POST_IMAGE_PATH = 'public\storage\posts\default-avatar-image.png';

    public function createUniqueName($name)
    {
        return  Str::of($name)->slug('-') . "-" . Str::of(now()->toDateTimeString())->slug('-');
    }
    
    abstract public function uploadImage(UploadedFile $imageFile, String $directory, String $name);
    abstract public function deleteImage($path);
}