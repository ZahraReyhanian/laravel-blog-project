<?php

namespace App\Http\Controllers\api\v1\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $category = Category::create($data);

        return response()->json([
            'data' => $category,
            'status' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
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
     * @return JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $data = $this->validateData($request);
        $category->update($data);

        return response()->json([
            'data' => $category,
            'status' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'data' => [],
            'status' => 'success'
        ], 200);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validateData(Request $request)
    {
        if ($request->parent) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'parent' => 'exists:categories,id',
            ]);
        } else {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255']
            ]);
        }
        return $data;
    }
}
