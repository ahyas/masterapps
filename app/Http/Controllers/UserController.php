<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
        $data = User::latest()
            ->where(function ($query) {
                if ($search = request()->search) {
                    $query->where('name', 'like', '%'.$search .'%')
                        ->orWhere('email', 'like', '%'.$search.'%')
                        ->orWhere('username', 'like', '%'.$search.'%');

                }
            })
            ->paginate(10)->withQueryString();

        return Inertia::render('Apps/Master/Users/Index', [
            'users' => $data
        ]);
    }
}
