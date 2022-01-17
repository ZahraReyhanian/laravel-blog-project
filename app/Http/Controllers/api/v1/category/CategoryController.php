<?php

namespace App\Http\Controllers\api\v1\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::query()->latest()->paginate(20);

        return response()->json([
            'data' => $categories,
            'status' => 'success'
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return void
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'data' => $category,
            'status' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        return response()->json([
            'data' => $category,
            'status' => 'success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        return response()->json([
            'data' => $category,
            'status' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return void
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'data' => [],
            'status' => 'success'
        ], 200);
    }
}
