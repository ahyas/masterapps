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
use Carbon\Carbon;

class MediasiController extends Controller
{
    public function Index():Response{
        if(Auth::user()->user_type == 'mediator'){
            $mediator = Mediator::find(Auth::user()->id);
            $data = $mediator->perkaras()->with(['pihaks', 'mediator', 'reviews'])
            ->withWhereHas('mediasi') //proses mediasi sudah berjalan di SIPP
            ->get();

            $reviews = $mediator->load('reviews');
        }else{

            $data = Perkara::with(['pihaks', 'mediator', 'mediasi', 'reviews'])
            ->whereHas('pihaks', function($query){
                return $query->where('pihaks.id', Auth::user()->id);
            })
            ->first();

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

    public function show_mediator($app_id, $perkara_id){
        //$mediator = Mediator::with('perkaras')->get();
        $mediator = Mediator::withCount('perkaras AS jumlah_perkara')
        ->withSum('reviews AS total_reviews', 'rating')
        ->withCount('reviews AS length_review')
        ->orderBy('jumlah_perkara', 'DESC')
        ->get();

        $nilai_mediator = DB::connection('mediasiapp_conn')
        ->table('mediators')
        ->select('mediators.id AS mediator_id', 'mediasis.hasil_mediasi', DB::raw('COUNT(mediasis.hasil_mediasi) AS count_mediasi'))
        ->leftjoin('perkaras', 'mediators.id', 'perkaras.mediator_id')
        ->leftjoin('mediasis', 'perkaras.mediasi_id', 'mediasis.id')
        ->groupBy('mediators.id', 'mediators.nama', 'mediasis.hasil_mediasi')
        ->orderBy('perkaras.mediator_id')
        ->get();

        $reviews = Mediator::with('reviews')->get();

        return Inertia::render('Apps/Mediator/DaftarMediator', [
            'mediator' => $mediator,
            'perkara_id' => $perkara_id,
            'reviews' => $reviews, 
            'nilai_mediator' => $nilai_mediator
        ]);
    }

    public function detail_mediator($app_id, $perkara_id, $mediator_id){
        $mediator = Mediator::find($mediator_id);
        $jumlah_keberhasilan = $mediator->perkaras()->withWhereHas('mediasi', function($query){
            $query->whereIn('hasil_mediasi', ['Y1', 'Y2', 'S']);
        })->get();

        return Inertia::render('Apps/Mediator/DetailMediator', [
            'mediator' => $mediator,
            'perkara_id' => $perkara_id,
            'mediator_id' => $mediator_id,
            'jumlah_keberhasilan' => $jumlah_keberhasilan->count()
        ]);
    }

    public function pilih_mediator($app_id, $perkara_id, $mediator_id){
        $perkara = Perkara::find($perkara_id);
        $mediator = Mediator::find($mediator_id);

        $perkara->mediator()->associate($mediator);
        $perkara->save();

        // DB::connection('mediasiapp_conn')->table('perkaras')->where('perkara_id', $perkara_id)->update([
        //    'mediator_pilihan_id' => $mediator_id 
        // ]);
        
        return redirect()->route('mediasi.index', ['app_id'=>$app_id]);
    }

    public function permintaan($app_id){
        $mediator = Mediator::find(Auth::user()->id);
        $data = $mediator->perkaras()->with(['pihaks', 'mediator', 'reviews'])
        ->doesntHave('mediasi')->get();

        return Inertia::render('Apps/Mediator/Permintaan/Index', [
            'data' => $data,
            'user_type' => Auth::user()->user_type,
        ]);
    }
}
