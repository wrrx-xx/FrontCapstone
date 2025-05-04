<?php

namespace App\Providers;

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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $pendingMaintenanceCount = 0;
            $pendingMaintenanceCountCaretaker = 0;
            if (\Illuminate\Support\Facades\Auth::check()) {
                $user = \Illuminate\Support\Facades\Auth::user();
                if ($user->ownerProfile && $user->ownerProfile->approved) {
                    $ownerId = $user->id;
                    $pendingMaintenanceCount = \App\Models\MaintenanceRequest::whereHas('listing', function ($query) use ($ownerId) {
                        $query->where('owner_id', $ownerId);
                    })->where('status', 'Pending')->count();
                }
                // For caretakers, count maintenance requests related to their owner with status Pending
                if ($user->role === 'caretaker') {
                    $ownerId = $user->owner_id;
                    $pendingMaintenanceCountCaretaker = \App\Models\MaintenanceRequest::whereHas('listing', function ($query) use ($ownerId) {
                        $query->where('owner_id', $ownerId);
                    })->where('status', 'Pending')->count();
                }
            }
            $view->with('pendingMaintenanceCount', $pendingMaintenanceCount);
            $view->with('pendingMaintenanceCountCaretaker', $pendingMaintenanceCountCaretaker);
        });
    }
}
