<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Services\Upload;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function  __construct()
    {
        if (env('APP_ENV') == 'local')
            $this->middleware('jwt.verify');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::with('image')
            ->get()
            ->map(function ($post) {
                return $post->specificInfo();
            });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Upload $uploadService)
    {
        $data = $request->only('user_id', 'title', 'content');

        try {
            $validator = Validator::make($data, [
                'user_id' => 'required|integer|min:1',
                'image' => 'image|mimes:jpg,png,jpeg,gif,bmp,svg|file|max:4096',
                'content' => 'required|string|min:1',
                'title' => 'required|string|min:1|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()], 400);
            }
            $post =  Post::create($data);

            $path = Upload::DEFAULT_POST_IMAGE_PATH;

            if ($request->image) {
                $path = $uploadService->uploadImage($request->image, "public/posts", $request->title);
            }

            $post->image()->create(['path' => $path]);
            return response()->json($post);
        } catch (QueryException $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]]);
        } catch (Exception $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Upload $uploadService)
    {

        try {
            $post = Post::find($id);

            $imagePath = $post->image->path;
            $uploadService->deleteImage($imagePath);
            $post->delete();
            $post->image->delete($post->image->id);
            return response()->json(['message' => 'you have successfully deleted ' . $imagePath]);
        } catch (Exception $e) {
            return response()->json(['error' => [
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]]);
        }
    }
}
