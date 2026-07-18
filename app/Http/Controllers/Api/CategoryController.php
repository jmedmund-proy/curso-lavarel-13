<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{

    public function all(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }
    
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::paginate(10));
    }

    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        return CategoryResource::collection(Category::create($request->validated()), 201);
    }

    public function show(Category $category): JsonResponse
    {
        return CategoryResource::collection($category);
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $category->update($request->validated());
        return CategoryResource::collection($category);
    }

    public function destroy(Category $category): AnonymousResourceCollection
    {
        $category->delete();
        return CategoryResource::collection(['mensaje' => 'Category eliminado'], 204);
    }
}
