<?php

namespace App\Http\Controllers\api\v1\post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return void
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
     * @return void
     */
    public function show(Post $post)
    {
        return response()->json([
            'data' => $post,
            'status' => 'success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return void
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
     * @return void
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'data' => [],
            'status' => 'success'
        ], 200);
    }
}