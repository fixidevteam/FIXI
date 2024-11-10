<?php

namespace App\Providers;

use App\Models\UserPapier;
use App\Models\Voiture;
use App\Models\VoiturePapier;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
            $user = Auth::user();
            if ($user) {
                $today = Carbon::now();
    
                // Get user car IDs
                $userCars = Voiture::where('user_id', $user->id)->pluck('id');
    
                // Count expiring personnel documents
                $personnelsCount = UserPapier::where('user_id', $user->id)
                    ->where(function ($query) use ($today) {
                        $query->where('date_fin', '<=', $today->copy()->addDays(7))
                              ->orWhere('date_fin', '<', $today);
                    })
                    ->count();
    
                // Count expiring vehicle documents
                $voituresCount = VoiturePapier::whereIn('voiture_id', $userCars)
                    ->where(function ($query) use ($today) {
                        $query->where('date_fin', '<=', $today->copy()->addDays(7))
                              ->orWhere('date_fin', '<', $today);
                    })
                    ->count();
    
                // Total notifications count
                $totalNotifications = $personnelsCount + $voituresCount;
    
                // Share the count with all views
                $view->with('notificationsCount', $totalNotifications);
            }
        });
    }
}