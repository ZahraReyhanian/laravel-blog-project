<?php

namespace App\Http\Controllers\api\v1\post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = Post::query()->latest()->paginate(20);

        return response()->json([
            'data' => $posts,
            'status' => 'success'
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'image' => $request->image,
            'description' => $request->description,
        ]);

        if ($request->has('categories'))
            $post->categories()->sync($request['categories']);

        return response()->json([
            'data' => $post,
            'status' => 'success'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post)
    {
        $comments = $this->getAllComments($post->comments()->where('parent_id', 0)->where('approved', 1)->get());


        $categories = $post->categories()->get();

        return response()->json([
            'data' => [
                "post" => $post,
                "comments" => $comments,
                "categories" => $categories
            ],
            'status' => 'success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        $post->categories()->sync($request['categories']);

        return response()->json([
            'data' => $post,
            'status' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'data' => [],
            'status' => 'success'
        ], 200);
    }

    private function getAllComments(\Illuminate\Database\Eloquent\Collection $comments)
    {
        if (!!$comments)
            foreach ($comments as $comment)
                $comment->child = $this->getAllComments($comment->child()->where('approved', 1)->get());
        return $comments;
    }
}
