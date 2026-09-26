<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        SEOMeta::setTitle('Blog con SEO Tools');
        SEOMeta::setCanonical(route('blog.index'));

        $posts = Post::where('posted','yes')->paginate(2);
        return view('blog.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        SEOMeta::setTitle($post->title);
        SEOMeta::setCanonical(route('blog.show', $post->slug));

        // 1. Manual
        if(Cache::has('post_show_' . $post->id)){
            return Cache::get('post_show_' . $post->id);
        }else{
            $cacheView = view('blog.show', ['post' => $post])->render();
            Cache::put('post_show_' . $post->id, $cacheView);
            return $cacheView;
        }

        // // 2. Automatico
        // $id = $post->id;
        // return cache()->rememberForever('post_show_' . $id, function () use ($id) {
        //     $post = Post::with('category')->find($id);
        //     return view('blog.show', ['post' => $post])->render();
        // });

        return view('blog.show', compact('post'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Post $post)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Post $post)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Post $post)
    // {
    //     //
    // }
}
