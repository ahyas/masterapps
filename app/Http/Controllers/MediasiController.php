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
            $data = $mediator->perkaras()->with(['pihaks', 'reviews'])->get();

            $reviews = $mediator->load('reviews');
        }else{

            $data = Perkara::with(['pihaks', 'mediator', 'mediasi', 'reviews'])
            ->whereHas('pihaks', function($query){
                return $query->where('pihaks.id', Auth::user()->id);
            })
            ->get();

            $perkara_pihak = Perkara::withWhereHas('pihaks', function($query){
                return $query->where('pihaks.id', Auth::user()->id);
            })->first();

            $mediator = $perkara_pihak->load('mediator');

            $reviews = $perkara_pihak->reviews()->where('user_id', Auth::user()->id)->first();

        }

        return Inertia::render('Apps/Mediator/Perkara/Index', [
            'data' => $data,
            'user_type' => Auth::user()->user_type,
            'review' => $reviews,
            'mediator' => $mediator
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
