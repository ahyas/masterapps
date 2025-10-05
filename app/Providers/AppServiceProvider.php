<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);

        JsonResource::withoutWrapping();
        
        try {
            foreach (Permission::pluck('slug') as $permission) {
                Gate::define($permission, function ($user) use ($permission) {
                    return $user->roles()->whereHas('permissions', function ($q) use ($permission) {
                        $q->where('slug', $permission);
                    })->count() > 0;
                });
            }
        } catch (\Exception $e) {
            info('registerUserAccessToGates: Database not found or not yet migrated. Ignoring user permissions while booting app.');
        }
    }
}
