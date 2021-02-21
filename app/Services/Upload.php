<?php

namespace App\Services;

use \Illuminate\Http\UploadedFile;
use \Illuminate\Support\Str;

abstract class Upload
{
    public const DEFAULT_IMAGE_PATH = 'public\avatars\default-avatar-image.png';

    public function createUniqueName($name)
    {
        return Str::of($name)->slug('-') . "-". now()->toDateTimeLocalString();
    }
    abstract public function uploadImage(UploadedFile $imageFile, String $directory, String $name);
    abstract public function deleteImage();
}