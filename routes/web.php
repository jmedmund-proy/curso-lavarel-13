<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Middleware\EnsureTeamMembership;
use App\Http\Middleware\UserIsAdminMiddleware;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', function () {
    return view('welcome', ['name' => 'Jhon']);
})->name('home');


// Route::get('/post', [PostController::class, 'index']);
// Route::get('/post/create', [PostController::class, 'create']);
// Route::get('/post/{post}', [PostController::class, 'edit']);
// Route::get('/post/delete/{post}', [PostController::class, 'destroy']);

// Route::group(['prefix' => 'dashboard'], function (){
//     Route::resource('post', PostController::class);
//     Route::resource('category', CategoryController::class);
// });

// Route::middleware([App\Http\Middleware\TestMiddleware::class])->group(function(){
    // Route::group(['prefix' => 'dashboard'], function (){
    //     Route::resource('post', PostController::class);
    //     Route::resource('category', CategoryController::class);
    // });
// });

// Route::group(['prefix' => 'dashboard', 'middleware' => [App\Http\Middleware\TestMiddleware::class]], function (){
//     Route::resource('post', PostController::class);
//     Route::resource('category', CategoryController::class);
//     // ->except('show');
//     // ->except(['show']);
//     // ->only(['show']);
//     // Route::resources([
//     //     'post' => PostController::class,
//     //     'category' => CategoryController::class
//     // ]);
// });

//Rutas de Perfil para usuario autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');;
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', UserIsAdminMiddleware::class]], function (){
    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class, 
    ]);
});

Route::group(['prefix' => 'blog'], function (){
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{post}', [BlogController::class, 'show'])->name('blog.show');
});

Route::get('/home', function () {
    return '<h1>HOLA A TOODS</h1>';
});

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::livewire('invitations/{invitation}/accept', 'pages::teams.accept-invitation')->name('invitations.accept');
});

require __DIR__.'/settings.php';

//RUTAS DE VIEW
Route::get('/vue', function () {
    return view('vue');
});
// Si hay 404 al abrir nueva pestaña
// Route::get('/vue/{n1?}/{n2?}/{n3?}', function () {
//     return view('vue');
// });
