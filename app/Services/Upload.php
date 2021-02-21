<?php

namespace App\Services;

use \Illuminate\Http\UploadedFile;
use \Illuminate\Support\Str;

abstract class Upload
{
    public function createUniqueName($name)
    {
        return Str::of($name)->slug('-') . "-" . now()->toDateTimeLocalString();
    }
    abstract public function uploadImage(UploadedFile $imageFile, String $directory, String $name);
    abstract public function deleteImage();
}