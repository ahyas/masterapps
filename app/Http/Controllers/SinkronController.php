<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SinkronController extends Controller
{
    public function index(){
        return Inertia::render('Apps/Master/Sinkron/Index');
    }

    public function sync($app_id){

    }
}
