<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SyncDataUser implements ShouldQueue
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

                DB::table('users')->upsert(
                    $data,
                    ['id'],
                    ['name', 'username', 'email', 'password', 'status_id']
                );
            });

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
