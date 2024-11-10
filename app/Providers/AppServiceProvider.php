<?php

namespace App\Providers;

use App\Models\UserPapier;
use App\Models\VoiturePapier;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
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
        View::composer('*', function ($view) {
            $today = Carbon::now();

            // Count expiring or expired paipers personnels
            $personnelsCount = UserPapier::where('date_fin', '<=', $today->copy()->addDays(7))
                ->orWhere('date_fin', '<', $today)
                ->count();

            // Count expiring or expired papiers voitures
            $voituresCount = VoiturePapier::where('date_fin', '<=', $today->copy()->addDays(7))
                ->orWhere('date_fin', '<', $today)
                ->count();

            // Total notifications count
            $totalNotifications = $personnelsCount + $voituresCount;

            // Share the count with all views
            $view->with('notificationsCount', $totalNotifications);
        });
    }
}