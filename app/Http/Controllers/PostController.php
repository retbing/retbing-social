<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Post;
use App\Services\Upload;
use AssertionError;
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


            if ($request->image) {
                $path = $uploadService->uploadImage($request->image, "public/posts", $request->title);
            }

            $post->image()->create(['path' => $path]);
            return response()->json($post);
        } catch (QueryException $e) {
            Handler::responseWithJson($e, Handler::QUERY_EXCEPTON);
        } catch (Exception $e) {
            Handler::responseWithJson($e, Handler::UNKNOWN_EXCEPTION);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        return Post::where('id', $post_id)->first()->detailedInfo();
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
            assert($post);
            $post->delete();
            $post->image->delete($post->image->id);

            $imagePath = $post->image->path;
            $uploadService->deleteImage($imagePath);
            return response()->json(['message' => 'you have successfully deleted ' . $imagePath]);
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, Handler::POST_NOT_FOUND);
        } catch (QueryException $e) {
            return Handler::responseWithJson($e, Handler::QUERY_EXCEPTON);
        } catch (Exception $e) {
            return Handler::responseWithJson($e);
        }
    }
}
