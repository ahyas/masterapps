<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
        $data = User::all();

        return Inertia::render('Apps/Master/Users/Index', [
            'users' => $data
        ]);
    }
}
