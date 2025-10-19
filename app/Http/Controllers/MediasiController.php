<?php

namespace App\Http\Controllers;

use App\Models\Perkara;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MediasiController extends Controller
{
    public function Index(){
        $a = Perkara::withWhereHas('pihaks', function($query){
            return $query->where('pihaks.id', Auth::user()->id);
        })->get();

        $perkara_pihak = Perkara::with(['pihaks', 'mediator'])
        ->whereHas('pihaks', function($query){
            return $query->where('pihaks.id', Auth::user()->id);
        })
        ->get();

        $test = Perkara::find(22121);
        $b = $test->mediator;

        return Inertia::render('Apps/Mediator/Perkara/Index', [
            'perkara_pihak' => $perkara_pihak,
            'a' => $a,
            'test' => $test,
            'b' => $b,
        ]);
    }
}
