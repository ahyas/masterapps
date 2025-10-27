<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TestController extends Controller
{

    public function index(){
        $perkara_mediasi = DB::connection('paboyo_sync_sipp')->table('perkara_mediasi AS a')
            ->whereYear('b.tanggal_pendaftaran', '>=', 2025)
            ->join('perkara AS b', 'a.perkara_id', 'b.perkara_id')
            ->select(
                'a.mediasi_id', 
                'a.perkara_id', 
                'a.penetapan_penunjukan_mediator',
                'a.dimulai_mediasi',
                'a.keputusan_mediasi',
                'a.tgl_kesepakatan_perdamaian',
                'a.hasil_mediasi',
                'a.isi_kesepakatan_perdamaian',
                'b.diinput_tanggal',  
                'b.diperbaharui_tanggal')
            ->get();

        $perkaras = DB::connection('mediasiapp_conn')->table('perkaras')
        ->get();

        return Inertia::render('Test/Index', [
            'perkara_mediasi' => $perkara_mediasi,
            'perkaras' => $perkaras,
        ]);
    }
}
