<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Mail\SubscribeEmail;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\App as AppLaravel;


class PostController extends Controller
{
    public function index()//:View
    {
        // Forzar idioma manualmente por controlador
        // AppLaravel::setLocale('es');
        // app()->setLocale('es');

        // Probar helper.php 
        // dd(hello("Mundo"));

        // Enviar correos, funcion en Mail/subscribeemanil
        // Mail::to('no-reply@example.net.com')
        //     ->send(new SubscribeEmail('contact@gmail.com', "SUPER PROMO", "<h1>VIVA ESTE PAIS</h1><p>Hola jabon</p>"));

        // Index clase 46
        //$posts = Post::get();
        // Index Paginado
        $posts = Post::with('category')->paginate(10);

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
        //Anterior
        // $post = Post::create($request->validated());
        //Validar con auth
        // $post = new Post($request->validated());
        // auth()->user()->posts()->save($post);
        //Validar con auth una sola linea
        auth()->user()->posts()->save(new Post($request->validated()));

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
        // En los GATES
        // if(!Gate::allows('update-post', $post)){
        //     abort(403);
        // }

        // Politica
        if(!Gate::allows('update', $post)){
            abort(403, 'SIN ACCESO WAWEAWAWA');
        }

        $categories = Category::pluck('id','title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post): RedirectResponse
    {
        if(!Gate::allows('update', $post)){
            abort(403);
        }

        $data = $request->Validated();
        if(isset($data['image'])){
            $data['image'] = $filename = time().'.'.$data['image']->extension();
            $request->image->move(public_path('image'), $filename);
        }
        
        $post->update($data);

        Cache::forget('post_show_' . $post->id);

        return to_route('post.index')->with('status', 'Post actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $post): RedirectResponse
    {
        if(!Gate::allows('delete', $post)){
            abort(403);
        }

        $post->delete();
        return to_route('post.index')->with('status', 'Post eliminado con éxito');
    }
}
