<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\UserPublicInfo;
use App\Models\User;
use App\Services\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPublicInfoController extends Controller
{
    //
    public function store(Request $request, Upload $uploadService)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096',
            'name' => 'required|string|max:255|min:1',
            'username' => 'required|string|max:255|min:1',
            'bio' => 'nullable|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }
        
        $file = $request->image;
        $username =  $request->username;
        $name =  $request->name;
        $bio = $request->bio;
        $userId = $request->user_id;

        $path = $uploadService->uploadImage($file, "public\avatars\\", $username);
        
        $user = User::find($userId);
        $user->userPubInf()->create(['username' => $username, 'name' => $name, 'bio' => $bio]);
        $user->userPubInf->image()->create(['path' => $path]);

        return $user;
    }
}