<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SyncDataPihakJob implements ShouldQueue
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
                $pihak = $chunk->map(function($pihak){
                    return [
                        'id' => $pihak->pihak_id,
                        'nama' => $pihak->pihak_nama,
                        'tempat_lahir' => $pihak->tempat_lahir,
                        'tanggal_lahir' => $pihak->tanggal_lahir == '0000-00-00' ? null : $pihak->tanggal_lahir,
                        'alamat' => $pihak->alamat,
                        'pekerjaan' => $pihak->pekerjaan,
                    ];
                })->toArray();

                DB::connection('mediasiapp_conn')->table('pihaks')->upsert(
                    $pihak,
                    ['id'],
                    ['nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'pekerjaan']
                );

            });
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
