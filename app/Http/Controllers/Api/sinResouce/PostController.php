<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json(Post::paginate(10));
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json(Post::paginate(10));
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json(Post::create($request->validated()), 201);
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(StoreRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());
        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        // return response()->json("ok");
        return response()->json(['mensaje' => 'Post eliminado'], 204);
    }
}
