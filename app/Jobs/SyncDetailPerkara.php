<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SyncDetailPerkara implements ShouldQueue
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
        $this->union->chunk(200)->each(function($chunk){

            $detail_perkara = $chunk->map(function($detail_perkara){
                return [
                    'perkara_id' => $detail_perkara->perkara_id,
                    'pihak_id' => $detail_perkara->pihak_id,
                    'diinput_tanggal' => $detail_perkara->perkara_pihak_diinput_tanggal,
                    'diperbaharui_tanggal' => null,
                ];
            })->toArray();

            DB::connection('mediasiapp_conn')->table('perkara_pihak')->upsert(
                $detail_perkara,
                ['perkara_id', 'pihak_id'],
                ['pihak_id', 'diinput_tanggal', 'diperbaharui_tanggal']
            );
        });

    }
}
