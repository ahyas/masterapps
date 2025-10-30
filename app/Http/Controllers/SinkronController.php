<?php

namespace App\Http\Controllers;

use App\Jobs\SyncAllDataJob;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SinkronController extends Controller
{
    public function index(){
        return Inertia::render('Apps/Master/Sinkron/Index');
    }

    public function fetch_data($app_id){
        $mediasi_pihak1 = DB::connection('paboyo_sync_sipp')
            ->table('perkara_mediasi AS a')
            ->whereYear('b.tanggal_pendaftaran', '>=', 2025)
            ->join('perkara AS b', 'a.perkara_id', 'b.perkara_id')
            ->join('mediator AS c', 'a.mediator_id', 'c.id')
            ->join('perkara_pihak1 AS d', 'a.perkara_id', 'd.perkara_id')
            ->join('pihak AS f', 'd.pihak_id', 'f.id')
            ->join('perkara_mediator AS h', 'a.perkara_id', 'h.perkara_id')
            ->select(
                'a.perkara_id', 
                'a.mediasi_id', 
                'b.tanggal_pendaftaran', 
                'b.nomor_perkara', 
                'b.diinput_tanggal AS perkara_diinput_tanggal',  
                'b.diperbaharui_tanggal AS perkara_diperbaharui_tanggal',
                'f.id AS pihak_id', 
                'd.nama AS pihak_nama', 
                'd.diinput_tanggal AS perkara_pihak_diinput_tanggal', 
                'd.diperbaharui_tanggal AS perkara_pihak_diperbaharui_tanggal',
                'f.email AS pihak_email', 
                'f.nomor_indentitas AS pihak_nik', 
                'f.telepon', 
                'f.alamat',
                'f.tempat_lahir',
                'f.tanggal_lahir',
                'f.jenis_kelamin',
                'f.pekerjaan',
                'h.mediator_id');

            $mediasi_pihak2 = DB::connection('paboyo_sync_sipp')->table('perkara_mediasi AS a')
            ->whereYear('b.tanggal_pendaftaran', '>=', 2025)
            ->join('perkara AS b', 'a.perkara_id', 'b.perkara_id')
            ->join('mediator AS c', 'a.mediator_id', 'c.id')
            ->join('perkara_pihak2 AS e', 'a.perkara_id', 'e.perkara_id')
            ->join('pihak AS g', 'e.pihak_id', 'g.id')
            ->join('perkara_mediator AS h', 'a.perkara_id', 'h.perkara_id')
            ->select(
                'a.perkara_id', 
                'a.mediasi_id', 
                'b.tanggal_pendaftaran', 
                'b.nomor_perkara',  
                'b.diinput_tanggal AS perkara_diinput_tanggal',  
                'b.diperbaharui_tanggal AS perkara_diperbaharui_tanggal',  
                'g.id AS pihak_id', 
                'e.nama AS pihak_nama', 
                'e.diinput_tanggal AS perkara_pihak_diinput_tanggal', 
                'e.diperbaharui_tanggal AS perkara_pihak_diperbaharui_tanggal', 
                'g.email AS pihak_email', 
                'g.nomor_indentitas AS pihak_nik', 
                'g.telepon', 
                'g.alamat', 
                'g.tempat_lahir', 
                'g.tanggal_lahir', 
                'g.jenis_kelamin', 
                'g.pekerjaan', 
                'h.mediator_id');

                
            $union = $mediasi_pihak1->unionAll($mediasi_pihak2)->get();

            $data_mediator = DB::connection('paboyo_sync_sipp')->table('mediator')->select('id AS mediator_id', 'nama_gelar', 'tempat_lahir', 'tgl_lahir', 'alamat')->get();

            $perkara_mediasi = DB::connection('paboyo_sync_sipp')->table('perkara_mediasi AS a')
            ->whereYear('a.diinput_tanggal', '>=', 2025)
            ->select(
                'a.mediasi_id', 
                'a.perkara_id', 
                'a.penetapan_penunjukan_mediator',
                'a.dimulai_mediasi',
                'a.keputusan_mediasi',
                'a.tgl_kesepakatan_perdamaian',
                'a.hasil_mediasi',
                'a.isi_kesepakatan_perdamaian',
                'a.diinput_tanggal',  
                'a.diperbaharui_tanggal')
            ->get();

        SyncAllDataJob::dispatch($union, $data_mediator, $perkara_mediasi);

        return response()->json(['message' => 'Sync job queued successfully!']);
    }
}
