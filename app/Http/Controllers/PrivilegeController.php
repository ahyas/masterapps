<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrivilegeController extends Controller
{
    public function index(){
        $user_apps = User::with(['roles.app'])->get();

        $apps_users = App::with('users.roles')->get();
        
        return Inertia::render('Apps/Master/Privileges/Index', [
            'user_apps' => $user_apps,
            'apps_users' => $apps_users,
        ]); 
    }
}
