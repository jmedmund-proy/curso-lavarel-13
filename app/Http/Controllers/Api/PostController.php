<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Storage;

class PostController extends Controller
{
    public function all(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::all());
    }

    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('category')->paginate(6));
    }

    public function show(Post $post): AnonymousResourceCollection
    {
        return PostResource::collection($post);
    }

    public function slug(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return response()->json($post);
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request): PostResource
    {
        return new PostResource(Post::create($request->validated()), 201);
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(StoreRequest $request, Post $post): PostResource
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        // return response()->json("ok");
        return response()->json(['mensaje' => 'Post eliminado'], 204);
    }

    function upload(Request $request, Post $post){

        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:1024'
        ]);

        Storage::disk('public_upload')->delete("image/".$post->image);

        $data['image'] = $filename = time() . '.' . $request['image']->extension();

        $request->image->move(public_path('image'), $filename);

        $post->update($data);

        return response()->json($post);
    }
}
