<?php

namespace App\Http\Controllers;

use AssertionError;
use App\Models\Follow;
use App\Models\User;
use App\Exceptions\Handler;
use App\Models\UserPublicInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;


use Illuminate\Http\Request;

class FollowController extends Controller
{

      /**
     * Returns all followers of a user
     * @return Collection
     */
    public function followers(int $user_id)
    {
        try {
            $user = User::find($user_id);
            assert($user);
            
            return Follow::with('follower_user')
            ->with('follower_image')
            ->where('following_id', $user_id)
            ->get()
            ->map(function (Follow $follow) {
                return $follow->follower_user->smallDetails();
            });
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, Handler::USER_NOT_FOUND, 404);
        }
    }

    /**
     * Returns all followings of a user
     * @return Collection
     */
    public function followings(int $user_id)
    {
        try {
            $user = User::find($user_id);
            assert($user);
        
            return Follow::with('follower_user')
            ->with('following_image')
            ->where('follower_id', $user_id)
            ->get()
            ->map(function (Follow $follow) {
                return $follow->following_user->smallDetails();
            });
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, Handler::USER_NOT_FOUND, 404);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, int $id)
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
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
            return Handler::responseWithJson($e, Handler::USER_NOT_FOUND, 404);
        } catch (QueryException $e) {
            return Handler::responseWithJson($e, Handler::QUERY_EXCEPTON);
        }
    }
}