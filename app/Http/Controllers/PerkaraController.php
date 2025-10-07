<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PerkaraController extends Controller
{
    public function index(){

        return Inertia::render('Apps/Mediator/Perkara/Index');
    }
}
