<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrivilegeController extends Controller
{
    public function index(){
        $user_apps = User::with(['apps'])
        ->get();
        
        return Inertia::render('Apps/Master/Privileges/Index', [
            'user_apps' => $user_apps
        ]); 
    }
}
