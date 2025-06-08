<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->pelamar) {
                $unreadNotificationsCount = Notification::where('pelamar_id', Auth::user()->pelamar->id)
                                                ->where('is_read', false)
                                                ->count();
                
                $view->with('unreadNotificationsCount', $unreadNotificationsCount);
            }
        });
    }
}
