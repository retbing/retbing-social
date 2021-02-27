<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostActivity;
use AssertionError;
use Exception;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function like(Request $r, $post_id)
    {

        try {
            $post_activity  = PostActivity::where('post_id', $post_id)->first();
            assert($post_activity);
            Post::find($post_id)->likes()->create(['liked_by' => $r->user_id]);
            $post_activity->increaseLikes();

            return $post_activity;
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, Handler::POST_NOT_FOUND);
        } catch (Exception $e) {
            return Handler::responseWithJson($e);
        }
    }
    public function dislike($post_id)
    {

        try {
            $post_activity  = PostActivity::where('post_id', $post_id)->first();
            assert($post_activity);
            Post::find($post_id)->likes()->delete();

            $post_activity->decreaseLikes();
            
            return $post_activity;
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, Handler::POST_NOT_FOUND);
        } catch (Exception $e) {
            return Handler::responseWithJson($e);
        }
    }

    public static function  isLikedByAuth($post_id)
    {
        return count(Like::where()->where('liked_by', auth('api')->user()->id)->where('likeable_id', $post_id)->get()) > 0 ? true : false;
    }
}
