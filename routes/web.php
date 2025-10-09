<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AppRedirect;
use App\Http\Controllers\MediasiController;
use App\Http\Controllers\PerkaraController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidasiAkunController;
use App\Models\App;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    Route::prefix('/app_master/{app_id}')->group(function(){
        Route::get('/dashboard', function(){
            $app_user = User::find(Auth::user()->id)
            ->apps;

            return Inertia::render('Apps/Master/Dashboard', [
                'app_user' => $app_user,
            ]);
        })->name('app.master');

        Route::get('/users', [UserController::class, 'index'])->name('app.master.user');
        Route::prefix('/privileges')->group(function(){
            Route::get('/', [PrivilegeController::class, 'index'])->name('privileges.index');
            Route::resource('/roles', RoleController::class);
            Route::resource('/permissions', PermissionController::class);
        });
        Route::get('/apps', [AppController::class, 'index'])->name('app.master.app');
    });

    Route::prefix('/app_mediator/{app_id}')->group(function(){
        Route::get('/dashboard', function($app_id){
           
            $app_user = User::find(Auth::user()->id)
            ->apps;

            return Inertia::render('Apps/Mediator/Dashboard', [
                'app_user' => $app_user,
            ]);
        })->name('app.mediator'); 

        Route::group(['middleware' => 'can:view_perkara'], function(){
            Route::get('/perkara', [PerkaraController::class, 'index'])->name('app.mediator.perkara');
        });

        Route::group(['middleware' => 'can:manage_mediasi'], function(){
            Route::get('/mediasi', [MediasiController::class, 'index'])->name('mediasi.index');
        });

        Route::group(['middleware' => 'can:validasi_akun'], function(){
            Route::get('/validasi_akun', [ValidasiAkunController::class, 'index'])->name('validasi_akun.index');
        });

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
        $user_apps = $user->apps->unique('slug')->select('id','name', 'route_name')->values();
        $route_name = $user_apps->first();
        $asd = $route_name['route_name'];
        
        //display apps roles and permission (for super admin)
        $app_role = $app->load('roles');

        //get current users access to each apps (role and permission)
        $roles_mediator_app = $user->rolesForApp(1)->load('permissions');
        $roles_bukutamu_app = $user->rolesForApp(2)->load('permissions');

        $can = Auth::user()->can('memilih_mediator');
        
        //batas tanggal
        $first_date = new DateTime('2025-09-01 00:00:00');

        //last date 
        $last_date = new DateTime('2025-09-15 00:00:00');

        //user yang masuk tahap mediasi
        $mediasi = DB::connection('paboyo_sync_sipp')->table('perkara_mediasi')
        ->where('diinput_tanggal', '>=', $first_date)
        ->where('diinput_tanggal', '<=', $last_date)
        ->get();

        foreach ($mediasi as $row) {
            DB::connection('mediasiapp_conn')->table('transactions')->updateOrInsert(
                ['id' => $row->id],
                (array) $row
            );
        }

        return response()->json([
            'mediasi' => [
                'jumlah'=>$mediasi->count(),
                'table'=>$mediasi
            ],
            'user_apps'=>$user_apps, 
            'asd'=>$asd, 
            'roles_mediator_app'=>$roles_mediator_app, 
            'roles_bukutamu_app'=>$roles_bukutamu_app,
            'app_role' => $app_role,
            'can' => $can,
        ]);
    });


});

require __DIR__.'/auth.php';
