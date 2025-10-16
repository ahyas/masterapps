<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncDataAppRoleUser implements ShouldQueue
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
                $app_role_user = $chunk->map(function($user){
                    return [
                        'app_id' => 1,
                        'role_id' => 4,
                        'user_id' => $user->pihak_id,
                    ];
                })->toArray();

                DB::table('app_role_user')
                ->upsert(
                    $app_role_user,
                    ['app_id', 'role_id', 'user_id'],
                    ['app_id', 'role_id', 'user_id']
                );
            });
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
