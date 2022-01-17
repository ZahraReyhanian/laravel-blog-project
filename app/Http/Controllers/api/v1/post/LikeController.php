<?php

namespace App\Http\Controllers\api\v1\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoritePost(Post $post)
    {
        auth()->user()->favorites()->attach($post->id);
        $post->update([
            'likeCount' => $post->likeCount + 1
        ]);

        return response()->json(['status' => "success", 'data' => $post], 200);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function unFavoritePost(Post $post)
    {
        auth()->user()->favorites()->detach($post->id);
        if ($post->likeCount > 0) {
            $post->update([
                'likeCount' => $post->likeCount - 1
            ]);
        }

        return response()->json(['status' => "success", 'data' => $post], 200);
    }
}
