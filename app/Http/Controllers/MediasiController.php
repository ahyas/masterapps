<?php

namespace App\Http\Controllers;

use App\Models\Mediasi;
use App\Models\Mediator;
use App\Models\Perkara;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class MediasiController extends Controller
{
    public function Index():Response{
        if(Auth::user()->user_type == 'mediator'){
            $mediator = Mediator::find(Auth::user()->id);
            $data = $mediator->perkaras->load('pihaks');
        }else{
            $a = Perkara::withWhereHas('pihaks', function($query){
            return $query->where('pihaks.id', Auth::user()->id);
            })->get();

            $data = Perkara::with(['pihaks', 'mediator', 'mediasi', 'reviews'])
            ->whereHas('pihaks', function($query){
                return $query->where('pihaks.id', Auth::user()->id);
            })
            ->get();   
        }

        $test = Perkara::find(22121);
        $test2 = Perkara::find(22059);
        $b = $test->mediator;
        $mediasi = $test2->mediasi;

        return Inertia::render('Apps/Mediator/Perkara/Index', [
            'data' => $data,
            'user_type' => Auth::user()->user_type,
            'mediasi' => $mediasi,
            'review' => $test->load(['mediator', 'reviews']),
        ]);
    }

    public function penilaian($app_id, $mediator_id):Response{
        return Inertia::render('Apps/Mediator/Penilaian/Create', [
            'mediator_id' => $mediator_id
        ]);
    }

    public function createPenilaian($app_id, $mediator_id){
        return response()->json($mediator_id);
    }
}
