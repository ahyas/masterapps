<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MediasiController extends Controller
{
    public function Index(){
        
        return Inertia::render('Apps/Mediator/Perkara/Index', [
            'perkara_mediasi' => "",
            'current_user' => ""
        ]);
    }
}
