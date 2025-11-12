<?php

namespace App\Http\Controllers;

use App\Models\Mediator;
use App\Models\Perkara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ReviewController extends Controller
{

    public function create($app_id, $perkara_id):Response{
        $perkara = Perkara::find($perkara_id);
        return Inertia::render('Apps/Mediator/Penilaian/Create', [
            'perkara_id' => $perkara_id,
            'mediator' => $perkara->mediator,
        ]);
    }

    public function store($app_id, $perkara_id, Request $request){
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'testimony' => 'nullable|string|max:500',
        ]);

        $perkara = Perkara::find($perkara_id);

        $perkara->reviews()->updateOrCreate(
            [
                'perkara_id' =>$perkara_id, 
                'mediator_id' => $request->mediator_id, 
                'user_id' => Auth::user()->id
            ],
            [
                'rating' => $validated['rating'],
                'testimony' => $validated['testimony'
            ] ?? null,
        ]);

        return redirect()->route('mediasi.index', ['app_id' => $app_id]);

        //return response()->json($perkara->reviews);
    }

    public function show(Mediator $mediator)
    {
        
    }

}
