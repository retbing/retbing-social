<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class UserPublicInfoController extends Controller
{
    /**
     * Stores a new UserPublicInfo with given user_id and uploads its image if provided
     *
     * @return \App\Models\User
     */
    public function store(Request $request, Upload $uploadService)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|min:1',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
            'name' => 'required|string|max:255|min:1',
            'username' => 'required|string|max:255|min:1',
            'bio' => 'string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }
        
        $file = $request->image;
        $username =  $request->username;
        $name =  $request->name;
        $bio = $request->bio;
        $userId = $request->user_id;
        $path = Upload::DEFAULT_IMAGE_PATH;

        try {
            $user = User::find($userId);
            $user->userPubInf()->create(['username' => $username, 'name' => $name, 'bio' => $bio]);
            
            if ($file) {
                $path = $uploadService->uploadImage($file, "avatars", $username);
            }
            
            $user->userPubInf->image()->create(['path' => $path]);
            
            return $user;
        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode()
              ], 500);
        }
    }
}