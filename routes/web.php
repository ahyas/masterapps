<?php

use App\Http\Controllers\AppRedirect;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Models\App;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    $user = User::find(Auth::user()->id);
    $user_apps = $user->apps->unique('slug')->select('id','name', 'route_name')->values();

    return Inertia::render('Dashboard', [
        'app_user' => $user_apps
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/app_mediator')->group(function(){
        Route::get('/{app_id}/dashboard', function($app_id){
           
            $app_user = User::find(Auth::user()->id)
            ->apps;

            return Inertia::render('Apps/Mediator/Dashboard', [
                'app_user' => $app_user,
            ]);
        })->name('app.mediator'); 
    });

    Route::prefix('/app_bukutamu')->group(function(){
        Route::get('/{app_id}/dashboard', function($app_id){
            $app_user = User::find(Auth::user()->id)
            ->with('apps')->first();

            return Inertia::render('Apps/Bukutamu/Dashboard', [
                'app_user' => $app_user,
            ]);
        })->name('app.bukutamu');
    });

    Route::get('/test', function(){
        $user = User::find(Auth::user()->id);
        $app = App::all();
        
        //get apps access for current user
        $user_apps = $user->apps->unique('slug')->select('id','name')->values();
        
        //display apps roles and permission (for super admin)
        $app_role = $app->load('roles');

        //get current users access to each apps (role and permission)
        $roles_mediator_app = $user->rolesForApp(1)->load('permissions');
        $roles_bukutamu_app = $user->rolesForApp(2)->load('permissions');
  
        return response()->json([
            'user_apps'=>$user_apps, 
            'roles_mediator_app'=>$roles_mediator_app, 
            'roles_bukutamu_app'=>$roles_bukutamu_app,
            'app_role' => $app_role
        ]);
    });


});

require __DIR__.'/auth.php';
