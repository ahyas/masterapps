<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppController extends Controller
{
    public function index(){
        $data = App::all();

        return Inertia::render('Apps/Master/Apps/Index',[
            'apps' => $data
        ]);
    }
}
