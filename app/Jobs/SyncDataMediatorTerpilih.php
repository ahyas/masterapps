<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SyncDataMediatorTerpilih implements ShouldQueue
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
                        'mediator_id' => $perkara->mediator_id
                    ];
                })->toArray();

                DB::connection('mediasiapp_conn')->table('perkaras')->upsert(
                    $perkara,
                    [
                        'id'
                    ],
                    [
                        'mediator_id',
                    ]
                );
            });

            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
