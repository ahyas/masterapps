<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class SyncDataSIPPJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $timeout = 300;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Sync data SIPP has started');

        try {
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
                'h.mediator_id');

                
            $union = $mediasi_pihak1->unionAll($mediasi_pihak2)->get();
        
            $union->chunk(200)->each(function($chunk){
                $data = $chunk->map(function($user){
                    return [
                        'id' => $user->pihak_id,
                        'name' => $user->pihak_nama,
                        'username' => $user->pihak_nik,
                        'email' => $user->pihak_email,
                        'password' => Hash::make('mediasi'),
                        'status_id' => 2,
                    ];
                })->toArray();

                $app_role_user = $chunk->map(function($user){
                    return [
                        'app_id' => 1,
                        'role_id' => 4,
                        'user_id' => $user->pihak_id,
                    ];
                })->toArray();

                $perkara = $chunk->map(function($perkara){
                    return [
                        'id' => $perkara->perkara_id,
                        'tgl_pendaftaran' => $perkara->tanggal_pendaftaran,
                        'nomor_perkara' => $perkara->nomor_perkara,
                        'mediator_id' => $perkara->mediator_id,
                        'diinput_tgl' => $perkara->perkara_diinput_tanggal,
                        'diperbaharui_tgl' => $perkara->perkara_diperbaharui_tanggal ? $perkara->perkara_diperbaharui_tanggal : null,
                    ];
                })->toArray();

                $detail_perkara = $chunk->map(function($detail_perkara){
                    return [
                        'perkara_id' => $detail_perkara->perkara_id,
                        'pihak_id' => $detail_perkara->pihak_id,
                        'diinput_tanggal' => $detail_perkara->perkara_pihak_diinput_tanggal,
                        'diperbaharui_tanggal' => null,
                    ];
                })->toArray();

                DB::table('users')->upsert(
                    $data,
                    ['id'],
                    ['name', 'username', 'email', 'password', 'status_id']
                );

                DB::table('app_role_user')
                ->upsert(
                    $app_role_user,
                    ['app_id', 'role_id', 'user_id'],
                    ['app_id', 'role_id', 'user_id']
                );

                DB::connection('mediasiapp_conn')->table('perkaras')->upsert(
                    $perkara,
                    ['id'],
                    ['tgl_pendaftaran', 'nomor_perkara', 'mediator_id','diinput_tgl', 'diperbaharui_tgl']
                );

                DB::connection('mediasiapp_conn')->table('detail_perkara')->upsert(
                    $detail_perkara,
                    ['perkara_id', 'pihak_id'],
                    ['pihak_id', 'diinput_tanggal', 'diperbaharui_tanggal']
                );
            });

        Log::info('SyncUsersJob finished successfully.');
        
        } catch (\Throwable $e) {
            Log::error('SyncUsersJob failed', ['message' => $e->getMessage()]);
            throw $e;
        }

    }
}
