<?php

namespace App\Providers;

use App\Http\Controllers\Repository\UserRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return 'https://vw.oficinabrasil.com.br/update-password?token='.$token;
        });
    }
}
