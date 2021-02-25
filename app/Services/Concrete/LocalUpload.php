<?php

namespace App\Services\Concrete;

use App\Services\Upload;
use \Illuminate\Http\UploadedFile;

class LocalUpload extends Upload
{
    public function uploadImage($imageFile, String $directory, String $name)
    {
        $uniqueName =  $this->createUniqueName($name) . "." . $imageFile->getClientOriginalExtension();
        $path = $imageFile->storeAs($directory, $uniqueName);
        return $path == false ? self::DEFAULT_AVATAR_PATH : $path;
    }

    public function deleteImage($path)
    {
        return unlink(storage_path('app/' . $path));
    }
}