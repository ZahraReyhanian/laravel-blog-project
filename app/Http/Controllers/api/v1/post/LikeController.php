<?php

namespace App\Http\Controllers\api\v1\post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *      path="/{id}/like",
     *      operationId="likePost",
     *      tags={"favorites"},
     *      summary="Like a post",
     *      description="Returns post data",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Post")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      )
     * )
     */
    public function favoritePost(Post $post)
    {
        auth()->user()->favorites()->attach($post->id);
        $post->update([
            'likeCount' => $post->likeCount + 1
        ]);

        return response()->json(['status' => "success", 'data' => $post], 201);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *      path="/{id}/unlike",
     *      operationId="UnlikePost",
     *      tags={"favorites"},
     *      summary="Unlike a post",
     *      description="Returns post data",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Post")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    public function unFavoritePost(Post $post)
    {
        auth()->user()->favorites()->detach($post->id);
        if ($post->likeCount > 0) {
            $post->update([
                'likeCount' => $post->likeCount - 1
            ]);
        }

        return response()->json(['status' => "success", 'data' => $post], 201);
    }
}
