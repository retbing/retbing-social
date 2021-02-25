<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* protect functions except login and register using middleware 'jwt.verify' */

        $this->middleware('jwt.verify', ['except' => ['login','register']]);
    }

    /**
     * register and Stores User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $credentials = request(['email', 'password']);

        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12'
            ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->messages()]);
        } else {
            $user = User::create($credentials);


            $token = JWTAuth::fromUser($user);

            return $this->respondWithToken($token);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }


        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Delete a user and the avater uploaded with it 
     *
     * @return String Message
     */
    public function deleteUser($id, Upload $uploadService)
    {
        $user =  User::find($id);
        if ($user && auth('api')->user()->id == $user->id) {

            $imagePath = $user->user_public_info->image->path;
            $uploadService->deleteImage($imagePath);

            $user->user_public_info->image->delete();

            $user->delete();
            return response()->json(['message' => 'we really feel sad to see you go!']);
        } else {
            return response()->json(['error' => 'a user can only delete him/her self!']);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}