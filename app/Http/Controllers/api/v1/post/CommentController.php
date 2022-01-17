<?php

namespace App\Http\Controllers\api\v1\post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::query()->latest()->paginate(20);

        return response()->json([
            'data' => $comments,
            'status' => 'success'
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(Request $request)
    {
        $data = $request->validate([
            'commentable_type' => 'required',
            'commentable_id' => 'required',
            'parent_id' => 'required',
            'comment' => 'required',
        ]);

        auth()->user()->comments()->create($data);
        return response()->json([
            'data' => 'پیام شما با موفقیت ثبت شد و پس از تائید نمایش داده خواهد شد .',
            'status' => 'success'
        ], 200);

    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Comment $comment)
    {
        $comment->update([
            'approved' => 1
        ]);
        return response()->json([
            'data' => 'پیام مورد نظر تائید شد',
            'status' => 'success'
        ], 200);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function unconfirm(Comment $comment)
    {
        $comment->update([
            'approved' => 0
        ]);
        return response()->json([
            'data' => 'پیام مورد نظر مردود شد',
            'status' => 'success'
        ], 200);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'data' => 'پیام مورد نظر حذف شد',
            'status' => 'success'
        ], 200);

    }
}
