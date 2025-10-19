<?php

namespace App\Jobs;

use Doctrine\DBAL\Query\Union;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncAllDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */

    protected $union;
    protected $data_mediator;

    public function __construct($union, $data_mediator)
    {
        $this->union = $union;
        $this->data_mediator = $data_mediator;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Dispatch each sync job separately
        SyncDataMediatorJob::dispatch($this->data_mediator);
        SyncDataPihakJob::dispatch($this->union);
        SyncDataUser::dispatch($this->union, $this->data_mediator);
        SyncDataAppRoleUser::dispatch($this->union);
        SyncDataPerkara::dispatch($this->union);
        SyncDetailPerkara::dispatch($this->union);
    }
}
