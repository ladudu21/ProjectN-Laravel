<?php

namespace App\Providers;


use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer(['layouts.client-layout', 'admin.dashboard'], function (View $view) {
            if (Auth::check()) {
                $notifications = Auth::user()->unreadNotifications()->orderBy('created_at','desc')->get();
                $view->with('notifications', $notifications);
            }
        });
    }
}
