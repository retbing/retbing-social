<?php

namespace App\Services\Concrete;

use App\Services\Upload;
use \Illuminate\Http\UploadedFile;

class LocalUpload extends Upload
{
    public function uploadImage(UploadedFile $imageFile, String $directory, String $name)
    {
        $path =   $directory.
        $this->createUniqueName($name).
        ".".
        $imageFile->extension();
        $imageFile->store('avatars');
        return $path;
    }

    public function deleteImage()
    {
    }
}