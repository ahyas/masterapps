<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SyncDataMediatorJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;
    public $timeout = 300;

    /**
     * Create a new job instance.
     */
    protected $data_mediator;

    public function __construct($data_mediator)
    {
        $this->data_mediator = $data_mediator;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Sync data SIPP has started');

        try {
            

            $this->data_mediator->chunk(200)->each(function($chunk){
                $data = $chunk->map(function($mediator){
                    return [
                        'id' => $mediator->mediator_id,
                        'nama' => $mediator->nama_gelar,
                        'tempat_lahir' => $mediator->tempat_lahir,
                        'tgl_lahir' => $mediator->tgl_lahir == '0000-00-00' ? null : $mediator->tgl_lahir
                    ];
                })->toArray();

                DB::connection('mediasiapp_conn')->table('mediators')->upsert(
                    $data,
                    ['id'],
                    ['nama', 'tempat_lahir', 'tgl_lahir']
                );

            });
        } catch (\Throwable $e) {
            Log::error('SyncUsersJob failed', ['message' => $e->getMessage()]);
            throw $e;
        }
        
        Log::info('SyncUsersJob finished successfully.');

    }
}
