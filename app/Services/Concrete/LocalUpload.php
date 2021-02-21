<?php

namespace App\Services\Concrete;

use App\Services\Upload;
use \Illuminate\Http\UploadedFile;

class LocalUpload extends Upload
{
    public function uploadImage(UploadedFile $imageFile, String $directory, String $name)
    {
        // $uniqueName =  $this->createUniqueName($name);
        $path = $imageFile->store('avatars');
        return $path == false ? self::DEFAULT_IMAGE_PATH : $path;
    }

    public function deleteImage()
    {
    }
}