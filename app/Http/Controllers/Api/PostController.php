<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function all(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::all());
    }

    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::paginate(10));
    }

    public function show(Post $post): AnonymousResourceCollection
    {
        return PostResource::collection($post);
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request): AnonymousResourceCollection
    {
        return PostResource::collection(Post::create($request->validated()), 201);
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(StoreRequest $request, Post $post): AnonymousResourceCollection
    {
        $post->update($request->validated());
        return PostResource::collection($post);
    }

    public function destroy(Post $post): AnonymousResourceCollection
    {
        $post->delete();
        // return response()->json("ok");
        return PostResource::collection(['mensaje' => 'Post eliminado'], 204);
    }
}
