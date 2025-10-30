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
        try {
            $this->union->chunk(200)->each(function($chunk){
                $app_role_user = $chunk->map(function($user){
                    return [
                        'app_id' => 1,
                        'role_id' => 2,
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

            $this->data_mediator->chunk(200)->each(function($a){
                
                $user_mediator = $a->map(function($mediator){
                return [
                    'app_id' => 1,
                    'role_id' => 3,
                    'user_id' => $mediator->mediator_id,
                ];
                })->toArray();

                DB::table('app_role_user')
                ->upsert(
                    $user_mediator,
                    ['app_id', 'role_id', 'user_id'],
                    ['app_id', 'role_id', 'user_id']
                );
            });
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
