<?php

namespace App\Http\Controllers;

use App\Models\Mediator;
use App\Models\Perkara;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MediasiController extends Controller
{
    public function Index(){
        if(Auth::user()->user_type == 'mediator'){
            $mediator = Mediator::find(Auth::user()->id);
            $data = $mediator->perkaras->load('pihaks');
        }else{
            $a = Perkara::withWhereHas('pihaks', function($query){
            return $query->where('pihaks.id', Auth::user()->id);
            })->get();

            $data = Perkara::with(['pihaks', 'mediator'])
            ->whereHas('pihaks', function($query){
                return $query->where('pihaks.id', Auth::user()->id);
            })
            ->get();   
        }

        $test = Perkara::find(22121);
        $b = $test->mediator;

        return Inertia::render('Apps/Mediator/Perkara/Index', [
            'data' => $data,
            'user_type' => Auth::user()->user_type,
        ]);
    }
}
