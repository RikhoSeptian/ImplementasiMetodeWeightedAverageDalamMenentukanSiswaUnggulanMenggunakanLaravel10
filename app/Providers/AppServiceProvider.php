<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin' ?? '';
        });

        Gate::define('guru', function (User $user) {
            return $user->role === 'guru' ?? '';
        });

        Gate::define('gurumapel', function (User $user) {
            return $user->guru->pembelajaran ?? '';
        });

        Gate::define('walikelas', function (User $user) {
            return $user->guru->kelas ?? '';
        });

        Gate::define('pembina', function (User $user) {
            return $user->guru->ekstrakurikuler ?? '';
        });

        // Gate::define('walisiswa', function (User $user) {
        //     return $user->role === 'walisiswa' ?? '';
        // });

        Gate::define('siswa', function (User $user) {
            return $user->role === 'siswa' ?? '';
        });
    }
}
