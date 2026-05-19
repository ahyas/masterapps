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
            //start: tarik seluruh data perkara, bukan hanya perkara mediasi
            $mediasi_pihak1 = DB::connection('paboyo_sync_sipp')->table('perkara AS b')
            ->whereYear('b.tanggal_pendaftaran', '>=', 2025)
            ->leftJoin('perkara_mediasi AS a', 'b.perkara_id', 'a.perkara_id')
            ->leftJoin('mediator AS c', 'a.mediator_id', 'c.id')
            ->join('perkara_pihak1 AS d', 'b.perkara_id', 'd.perkara_id')
            ->join('pihak AS e', 'd.pihak_id', 'e.id')
            ->leftJoin('perkara_mediator AS h', 'b.perkara_id', 'h.perkara_id')
            ->select(
                'b.perkara_id', //ok
                'a.mediasi_id', //ok
                'b.tanggal_pendaftaran', //ok
                'b.nomor_perkara', //ok
                'b.diinput_tanggal AS perkara_diinput_tanggal',  //ok
                'b.tahapan_terakhir_id AS tahapan_id',
                'b.proses_terakhir_id AS proses_id',
                'b.proses_terakhir_text AS proses_deskripsi',
                'b.tahapan_terakhir_text AS tahapan_deskripsi',
                'e.id AS pihak_id', //ok
                'd.nama AS pihak_nama', //ok
                'd.diinput_tanggal AS perkara_pihak_diinput_tanggal', //ok
                'd.diperbaharui_tanggal AS perkara_diperbaharui_tanggal', //ok
                'e.email AS pihak_email', //ok
                'e.nomor_indentitas AS pihak_nik', //ok
                'e.alamat', //ok
                'e.tempat_lahir', //ok
                'e.tanggal_lahir', //ok
                'e.jenis_kelamin', //ok
                'e.pekerjaan', //ok
                'h.mediator_id' //ok
            );

            $mediasi_pihak2 = DB::connection('paboyo_sync_sipp')->table('perkara AS b')
            ->whereYear('b.tanggal_pendaftaran', '>=', 2025)
            ->leftJoin('perkara_mediasi AS a', 'b.perkara_id', 'a.perkara_id')
            ->leftJoin('mediator AS c', 'a.mediator_id', 'c.id')
            ->join('perkara_pihak2 AS d', 'b.perkara_id', 'd.perkara_id')
            ->join('pihak AS e', 'd.pihak_id', 'e.id')
            ->leftJoin('perkara_mediator AS h', 'b.perkara_id', 'h.perkara_id')
            ->select(
                'b.perkara_id', //ok
                'a.mediasi_id', //ok
                'b.tanggal_pendaftaran', //ok
                'b.nomor_perkara', //ok
                'b.diinput_tanggal AS perkara_diinput_tanggal',  //ok
                'b.tahapan_terakhir_id AS tahapan_id',
                'b.proses_terakhir_id AS proses_id',
                'b.proses_terakhir_text AS proses_deskripsi',
                'b.tahapan_terakhir_text AS tahapan_deskripsi',
                'e.id AS pihak_id', //ok
                'd.nama AS pihak_nama', //ok
                'd.diinput_tanggal AS perkara_pihak_diinput_tanggal', //ok
                'd.diperbaharui_tanggal AS perkara_diperbaharui_tanggal', //ok
                'e.email AS pihak_email', //ok
                'e.nomor_indentitas AS pihak_nik', //ok
                'e.alamat', //ok
                'e.tempat_lahir', //ok
                'e.tanggal_lahir', //ok
                'e.jenis_kelamin', //ok
                'e.pekerjaan', //ok
                'h.mediator_id' //ok
            );
                
            $union = $mediasi_pihak1->unionAll($mediasi_pihak2)->get();
            //end: tarik seluruh data perkara, bukan hanya perkara mediasi

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
