<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\User;
use App\Models\Follow;
use App\Models\UserPublicInfo;
use App\Services\Upload;
use AssertionError;
use Illuminate\Http\Request;
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


    /**
     * Inserts a new UserPublicInfo and returns the inserted user
     *
     * @return User
     */
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
            return Handler::responseWithJson($e, Handler::USER_NOT_FOUND, 404);
        } catch (QueryException $e) {
            return Handler::responseWithJson($e, Handler::QUERY_EXCEPTON);
        }
    }

    /**
     * Returns all UserPublicInfos
     *
     * @return Collection
     */
    public function index()
    {
        return UserPublicInfo::with('image')
        ->get()
        ->map(function ($userPubInf) {
            return $userPubInf->smallDetails();
        });
    }

    /**
     * Returns the UserPublicInfo of the given user_id
     *
     * @return UserPublicInfo
     */
    public function show(int $id)
    {
        return UserPublicInfo::where('user_id', $id)
        ->with('image')
        ->get()
        ->map(function ($userPubInf) {
            return $userPubInf->fullDetails();
        });
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