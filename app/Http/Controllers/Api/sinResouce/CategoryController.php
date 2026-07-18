<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(): JsonResponse
    {
        return response()->json(Category::paginate(10));
    }

    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json(Category::create($request->validated()), 201);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json(Category::paginate(10));
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(['mensaje' => 'Category eliminado'], 204);
    }
}
