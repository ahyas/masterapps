<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AppRedirect;
use App\Http\Controllers\MediasiController;
use App\Http\Controllers\PerkaraController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SinkronController;
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
        Route::group(['middleware' => 'can:sinkron'], function(){
            Route::prefix('sinkron')->group(function(){
                Route::get('/', [SinkronController::class, 'index'])->name('app.master.sinkron');
                Route::get('/fetch_data', [SinkronController::class, 'fetch_data'])->name('app.master.fetch_data');
            });
        });
    });

    Route::prefix('/app_mediator/{app_id}')->group(function(){

        Route::group(['middleware'=>'can:access_mediator'], function(){

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

            Route::group(['middleware' => 'can:manage_hak_akses'], function(){
                Route::get('/hak_akses', [PrivilegeController::class, 'index'])->name('app.mediator.privileges');
            });

        });

    });

    Route::prefix('/app_bukutamu')->group(function(){
        Route::group(['middleware'=>'can:access_bukutamu'], function(){
            Route::get('/{app_id}/dashboard', function(){
                $app_user = User::find(Auth::user()->id)
                ->with('apps')->first();

                return Inertia::render('Apps/Bukutamu/Dashboard', [
                    'app_user' => $app_user,
                ]);
            })->name('app.bukutamu');
        });

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

        $mediasi_pihak1 = DB::connection('paboyo_sync_sipp')
        ->table('perkara_mediasi AS a')
        ->whereYear('b.tanggal_pendaftaran', '>=', 2025)
        ->join('perkara AS b', 'a.perkara_id', 'b.perkara_id')
        ->join('mediator AS c', 'a.mediator_id', 'c.id')
        ->join('perkara_pihak1 AS d', 'a.perkara_id', 'd.perkara_id')
        ->join('pihak AS f', 'd.pihak_id', 'f.id')
        ->join('perkara_mediator AS h', 'a.perkara_id', 'h.perkara_id')
        ->select(
            'a.perkara_id', 
            'b.tanggal_pendaftaran', 
            'b.nomor_perkara', 
            'b.diinput_tanggal AS perkara_diinput_tanggal',  
            'b.diperbaharui_tanggal AS perkara_diperbaharui_tanggal',
            'f.id AS pihak_id', 
            'd.nama AS pihak_nama', 
            'd.diinput_tanggal AS perkara_pihak_diinput_tanggal', 
            'd.diperbaharui_tanggal AS perkara_pihak_diperbaharui_tanggal',
            'f.email AS pihak_email', 
            'f.nomor_indentitas AS pihak_nik', 
            'f.telepon', 
            'f.alamat',
            'h.mediator_id');

        $mediasi_pihak2 = DB::connection('paboyo_sync_sipp')->table('perkara_mediasi AS a')
        ->whereYear('b.tanggal_pendaftaran', '>=', 2025)
        ->join('perkara AS b', 'a.perkara_id', 'b.perkara_id')
        ->join('mediator AS c', 'a.mediator_id', 'c.id')
        ->join('perkara_pihak2 AS e', 'a.perkara_id', 'e.perkara_id')
        ->join('pihak AS g', 'e.pihak_id', 'g.id')
        ->join('perkara_mediator AS h', 'a.perkara_id', 'h.perkara_id')
        ->select(
            'a.perkara_id', 
            'b.tanggal_pendaftaran', 
            'b.nomor_perkara',  
            'b.diinput_tanggal AS perkara_diinput_tanggal',  
            'b.diperbaharui_tanggal AS perkara_diperbaharui_tanggal',  
            'g.id AS pihak_id', 
            'e.nama AS pihak_nama', 
            'e.diinput_tanggal AS perkara_pihak_diinput_tanggal', 
            'e.diperbaharui_tanggal AS perkara_pihak_diperbaharui_tanggal ', 
            'g.email AS pihak_email', 
            'g.nomor_indentitas AS pihak_nik', 
            'g.telepon', 
            'g.alamat', 
            'h.mediator_id');

        $union = $mediasi_pihak1->unionAll($mediasi_pihak2)->orderBy('perkara_id', 'ASC')->get();
        $data_mediator = DB::connection('paboyo_sync_sipp')->table('mediator')->select('id', 'nama_gelar', 'tempat_lahir', 'tgl_lahir', 'alamat')->get();

        return response()->json([
            'count'=>$union->count(),
            'mediators'=>$data_mediator,
            'mediasi_pihak2'=>$union,
        ]);
        
    });


});

require __DIR__.'/auth.php';
