<?php

use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// Route::view('/', 'welcome', [
//     'canRegister' => Features::enabled(Features::registration()),
// ])->name('home');

// Route::get('/', function () {
//     return view('welcome', ['name' => 'Jhon']);
// });

Route::get('/', function () {
    return view('welcome');
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
