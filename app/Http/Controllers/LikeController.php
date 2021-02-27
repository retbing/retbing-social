<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\PostActivity;
use AssertionError;
use Exception;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function like($post_id)
    {

        try {
            $post_activity  = PostActivity::where('post_id', $post_id)->first();
            assert($post_activity);
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
            $post_activity->decreaseLikes();

            return $post_activity;
        } catch (AssertionError $e) {
            return Handler::responseWithJson($e, Handler::POST_NOT_FOUND);
        } catch (Exception $e) {
            return Handler::responseWithJson($e);
        }
    }
}
