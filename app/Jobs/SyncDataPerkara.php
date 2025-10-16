<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SyncDataPerkara implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $timeout = 300;

    /**
     * Create a new job instance.
     */
    protected $union;

    public function __construct($union)
    {
        $this->union = $union;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->union->chunk(200)->each(function($chunk){
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

                DB::connection('mediasiapp_conn')->table('perkaras')->upsert(
                    $perkara,
                    ['id'],
                    ['tgl_pendaftaran', 'nomor_perkara', 'mediator_id','diinput_tgl', 'diperbaharui_tgl']
                );
            });

            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
