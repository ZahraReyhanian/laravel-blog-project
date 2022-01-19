<?php

namespace App\Http\Controllers\api\v1\post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @return JsonResponse
     */
    /**
     * @OA\Get(
     *      path="/comment",
     *      operationId="getCommentsList",
     *      tags={"Comments"},
     *      summary="Get list of Comments",
     *      description="Returns list of comments",
     *      security={
     *           {"bearerAuth": {}}
     *       },
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $comments = Comment::query()->latest()->paginate(20);

        return response()->json([
            'data' => $comments,
            'status' => 'success'
        ], 200);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    /**
     * @OA\Get(
     *      path="/comment/{id}",
     *      operationId="getCommentById",
     *      tags={"Comments"},
     *      summary="Get comment information",
     *      description="Returns comment data",
     *      security={
     *           {"bearerAuth": {}}
     *       },
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Post")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'data' => $comment,
            'status' => 'success'
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    /**
     * @OA\Post(
     *      path="/comment",
     *      operationId="storeComment",
     *      tags={"Comments"},
     *      summary="Store new comment",
     *      description="Returns comment data",
     *     security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function comment(Request $request)
    {
        $data = $request->validate([
            'commentable_type' => 'required',
            'commentable_id' => 'required',
            'parent_id' => 'required',
            'comment' => 'required',
        ]);

        $comment = auth()->user()->comments()->create($data);

        return response()->json([
            'data' => $comment,
            'status' => 'success'
        ], 201);

    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    /**
     * @OA\Put(
     *      path="/comment/{id}",
     *      operationId="confirmComment",
     *      tags={"Comments"},
     *      summary="Update existing comment",
     *      description="Confirm a comment",
     *      security={{"bearerAuth":{}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\SecurityScheme(
     *          securityScheme="bearerAuth",
     *          type="http",
     *          scheme="bearer"
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function confirm(Comment $comment)
    {
        $comment->update([
            'approved' => 1
        ]);
        $comment->commentable->increment('commentCount');

        return response()->json([
            'data' => $comment,
            'status' => 'success'
        ], 202);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    /**
     * @OA\Put(
     *      path="/comment/{id}/unconfirm",
     *      operationId="unconfirmComment",
     *      tags={"Comments"},
     *      summary="Update existing comment",
     *      description="Unconfirm a comment",
     *      security={{"bearerAuth":{}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\SecurityScheme(
     *          securityScheme="bearerAuth",
     *          type="http",
     *          scheme="bearer"
     *      ),
     *
     *
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comment")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function unconfirm(Comment $comment)
    {
        $comment->update([
            'approved' => 0
        ]);
        $comment->commentable->decrement('commentCount');

        return response()->json([
            'data' => $comment,
            'status' => 'success'
        ], 202);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    /**
     * @OA\Delete(
     *      path="/comment/{id}",
     *      operationId="deleteComment",
     *      tags={"Comments"},
     *      summary="Delete existing post",
     *      description="Deletes a record and returns no content",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function delete(Comment $comment)
    {
        if ($comment->approved == 1) {
            $comment->commentable->decrement('commentCount');
        }
        $comment->delete();
        return response()->json([
            'data' => [],
            'status' => 'success'
        ], 204);

    }
}
