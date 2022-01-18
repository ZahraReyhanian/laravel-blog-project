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
        ], 200);

    }

    /**
     * @param Comment $comment
     * @return JsonResponse
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
        ], 200);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
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
        ], 200);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     */
    public function delete(Comment $comment)
    {
        if ($comment->approved == 1){
            $comment->commentable->decrement('commentCount');
        }
        $comment->delete();
        return response()->json([
            'data' => [],
            'status' => 'success'
        ], 200);

    }
}
