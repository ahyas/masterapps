<?php

namespace App\Http\Controllers;

use App\Models\Perkara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SearchPerkaraController extends Controller
{
    public function search_result(Request $request){

        $perkara_pihak = Perkara::where('nomor_perkara', $request->keyword)->with('pihaks')->first();

        $perkara_pihak_mediator = $perkara_pihak?->load('mediator');

        return Inertia::render('SearchResult/Index', [
            'keyword' => $request->keyword,
            'perkara_pihak' => $perkara_pihak,
            'perkara_pihak_mediator' => $perkara_pihak_mediator,
            'user_type' => 'pihak'
        ]);
    }
}
