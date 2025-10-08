<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MediasiController extends Controller
{
    public function Index(){
        return Inertia::render('Apps/Mediator/Perkara/Index');
    }
}
