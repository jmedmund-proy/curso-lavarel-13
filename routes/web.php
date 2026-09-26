<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Social\LoginTokenController;
use App\Http\Middleware\EnsureTeamMembership;
use App\Http\Middleware\LanguagePrefixMiddleware;
use App\Http\Middleware\UserIsAdminMiddleware;
use App\Jobs\SendSubscribeEmail;
use App\Jobs\TestJob;
use Illuminate\Support\Facades\Route;
use Laravel\Ai\Enums\Lab;

use function Laravel\Ai\agent;

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

// Cosas de Login por correo
Route::get('/login-token', [LoginTokenController::class, 'showEmailForm'])->name('auth.login-token-email');
Route::post('/login-token', [LoginTokenController::class, 'sendToken'])->name('auth.email-sendToken');
Route::get('/login-token/code', [LoginTokenController::class, 'showCodeForm'])->name('login.token.code');
Route::post('/login-token/code', [LoginTokenController::class, 'verifyToken'])->name('login.token.verify');
Route::post('/login-token/resend', [LoginTokenController::class, 'resendToken'])->name('auth.login-token-resend');

Route::group(['prefix' => 'dashboard', 'middleware' => 
['auth', UserIsAdminMiddleware::class, LanguagePrefixMiddleware::class]], function (){
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

// QUEUE AND JOBS
Route::get('/test-job', function(){
    TestJob::dispatch();
    SendSubscribeEmail::dispatch(auth()->user());
    return 'Super vista';
});

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::livewire('invitations/{invitation}/accept', 'pages::teams.accept-invitation')->name('invitations.accept');
    Route::group(['prefix' => 'dashboard'], function() {
        Route::group(['prefix' => 'category-live'], function() {
            Route::livewire('', 'pages::dashboard.category.index')->name('category.index');
            Route::livewire('create', 'pages::dashboard.category.save')->name('live.category.create');
            Route::livewire('edit/{id}', 'pages::dashboard.category.save')->name('live.category.edit');               
        });
        Route::group(['prefix' => 'post-live'], function() {
            Route::livewire('', 'pages::dashboard.post.index')->name('post.index');
            Route::livewire('create', 'pages::dashboard.post.save')->name('post.create');
            Route::livewire('edit/{id}', 'pages::dashboard.post.save')->name('post.edit');               
        });
        Route::group(['prefix' => 'tag-live'], function() {
            Route::livewire('', 'pages::dashboard.tag.index')->name('tag.index');
            Route::livewire('create', 'pages::dashboard.tag.save')->name('tag.create');
            Route::livewire('edit/{id}', 'pages::dashboard.tag.save')->name('tag.edit');               
        });
    });
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

// Laravel IA
Route::get('/laravel-ia-test', function () {
    // $response = agent(
    //     instructions: 'Eres un asistente experto en Laravel.',)->prompt(
    //         'Genera una lista de 3 temas de Laravel 13 en formato JSON', 
    //     provider: Lab::Gemini, 
    // );

    // Reintenta hasta 3 veces esperando 1000 milisegundos (1 seg) entre intentos
    $response = retry(3, function () {
        return agent(
            instructions: 'Eres un asistente experto en Laravel.',
        )->prompt(
            'Genera una lista de 3 temas de Laravel 13 en formato JSON',
            provider: Lab::Gemini,
        );
    }, 1000);

    dd($response);
});
