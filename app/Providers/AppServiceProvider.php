<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prevenir el problema de N+1 (recomendado para evitar problemas en produccion)
        Model::preventLazyLoading(!app()->isProduction());

        // Personalizar VITE atributos
        Vite::useScriptTagAttributes([
            'async' => true
        ]);

        Vite::useStyleTagAttributes([
            'custom-attribute' => true
        ]);

        // Gate::define('update-post', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });
        // Funciones CACHE
        Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });

        Gate::define('update-post', function(User $user, Post $post) {
            return $user->id == $post->user_id;
        });

        // Gate::define('update-view-user-admin', function ($user, $userParams, $permissionName) {
        //     return ($user->hasRole('Admin') || $userParams->hasRole('Admin')) && 
        //     $user->auth()->user()->hasPermission($permissionName);
        // });
        // Gate::define('is-admin', function ($user) {
        //     return $user->hasRole('Admin');
        // });

        //Default
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
