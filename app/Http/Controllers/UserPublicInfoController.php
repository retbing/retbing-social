<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\User;
use App\Models\Follow;
use App\Models\UserPublicInfo;
use App\Services\Upload;
use AssertionError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class UserPublicInfoController extends Controller
{
    public function __construct()
    {
        if (env('APP_ENV') == 'local') {
            $this->middleware('jwt.verify');
        } else {
        }
    }

    public function store(Request $request, Upload $uploadService)
    {
        $this->_validateRequest($request);

        try {
            $user = User::find($request->user_id);
            assert($user);
            
            $user->user_public_info()->create(['username' => $request->username, 'name' => $request->name, 'bio' => $request->bio]);

            $path = Upload::DEFAULT_AVATAR_PATH;
            
            if ($request->image) {
                $path = $uploadService->uploadImage($request->image, "avatars", $request->username);
            }
            
            $user->user_public_info->image()->create(['path' => $path]);
            
            return $user;
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, "User not found with given user_id " . $request->user_id, null, 404);
        } catch (QueryException $e) {
            return Handler::responseWithJson($e);
        }
    }

    public function index()
    {
        return UserPublicInfo::with('image')
        ->get()
        ->map(function ($userPubInf) {
            return $userPubInf->smallDetails();
        });
    }

    public function show(int $id)
    {
        return UserPublicInfo::where('user_id', $id)
        ->with('image')
        ->get()
        ->map(function ($userPubInf) {
            return $userPubInf->fullDetails();
        });
    }

    public function follow(Request $request, int $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'follower_id' => 'required|integer|min:1',
                ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()]);
            }
            $user = UserPublicInfo::where('user_id', $id)->first();
            assert($user);
            $follower_id = $request->follower_id;
            $user->follows()->create(['follower_id' => $follower_id]);
                
            return $user->follows;
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, "User not found with given id " . $id, null, 404);
        } catch (QueryException $e) {
            return Handler::responseWithJson($e);
        }
    }

    public function unfollow(Request $request, int $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'follower_id' => 'required|integer|min:1',
                ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()]);
            }
            $user = UserPublicInfo::where('user_id', $id)->first();
            assert($user);
            $follower_id = $request->follower_id;
            
            Follow::where(['follower_id' => $follower_id, 'following_id' => $id])->first()->delete();
                
            return $user->follows;
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, "User not found with given id " . $id, null, 404);
        } catch (QueryException $e) {
            return Handler::responseWithJson($e);
        }
    }


    /**
     * Validates incoming request and return errors if some is invalid
     */
    private function _validateRequest(Request $request)
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
    }
}