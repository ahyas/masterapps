<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SyncPerkaraMediasi implements ShouldQueue
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

            $data = $chunk->map(function($perkara_mediasi){
                return [
                    'id' => $perkara_mediasi->mediasi_id,
                    'penetapan_penunjukan_mediator' =>$perkara_mediasi->penetapan_penunjukan_mediator == '0000-00-00' ? null : $perkara_mediasi->penetapan_penunjukan_mediator,
                    'dimulai_mediasi' => $perkara_mediasi->dimulai_mediasi == '0000-00-00' ? null : $perkara_mediasi->dimulai_mediasi,
                    'keputusan_mediasi' => $perkara_mediasi->keputusan_mediasi,
                    'tgl_kesepakatan_perdamaian' => $perkara_mediasi->tgl_kesepakatan_perdamaian == '0000-00-00' ? null : $perkara_mediasi->tgl_kesepakatan_perdamaian,
                    'hasil_mediasi' => $perkara_mediasi->hasil_mediasi,
                    'isi_kesepakatan_perdamaian' => $perkara_mediasi->isi_kesepakatan_perdamaian,
                ];
            })->toArray();

            DB::connection('mediasiapp_conn')->table('mediasis')->upsert(
                $data,
                ['id'],
                ['penetapan_penunjukan_mediator', 'dimulai_mediasi', 'keputusan_mediasi', 'tgl_kesepakatan_perdamaian','hasil_mediasi','isi_kesepakatan_perdamaian']
            );
        });

    }
}
