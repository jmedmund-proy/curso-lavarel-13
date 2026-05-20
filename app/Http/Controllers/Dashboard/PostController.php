<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index()//:View
    {
        // Index clase 46
        //$posts = Post::get();
        // Index Paginado
        $posts = Post::paginate(10);
        session(['misesion' => 'Hola Mundo']);
        return view('dashboard.post.index', compact('posts'));

        // Clase de Categoria
        // Category::create([
        //     'title' => 'Cate 5',
        //     'slug' => 'cate-5'
        // ]);
        // echo Category::get();

        // Post::create([
        //     'title' => 'test',
        //     'slug' => 'test',
        //     'description' => 'test',
        //     'content' => 'test',
        //     'image' => 'test',
        //     'posted' => 'not',
        //     'category_id' => 2
        // ]);
        // echo Post::get();

        // $categories = Category::pluck('id','title');
        // dd($categories);
        // return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $categories = Category::pluck('id','title');
        $post = new Post();
        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        Post::create($request->validated());
        return to_route('post.index')->with('status', 'Post creado con éxito');

        // dd($request->all()['title']);

        // $res = Validator::make($request->all(),[
        //     'title' => 'required|min:5|max:500',
        //     'slug' => 'required|min:5|max:500',
        //     'content' => 'required|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required'
        // ]);

        // dd($res->fails());

        // $request->validate([
        //     'title' => 'required|min:5|max:500',
        //     'slug' => 'required|min:5|max:500',
        //     'content' => 'requierd|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required'
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post):View
    {
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post):View
    {
        $categories = Category::pluck('id','title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post): RedirectResponse
    {
        $data = $request->Validated();
        if(isset($data['image'])){
            $data['image'] = $filename = time().'.'.$data['image']->extension();
            $request->image->move(public_path('image'), $filename);
        }
        $post->update($data);
        return to_route('post.index')->with('status', 'Post actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $post): RedirectResponse
    {
        $post->delete();
        return to_route('post.index')->with('status', 'Post eliminado con éxito');
    }
}
