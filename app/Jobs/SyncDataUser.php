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
                
            $data = $chunk->map(function($user){
                $email = filter_var($user->pihak_email, FILTER_VALIDATE_EMAIL);
                return [
                    'id' => $user->pihak_id,
                    'user_type' => 'pihak',
                    'name' => $user->pihak_nama,
                    'username' => $user->pihak_nik,
                    'email' => filter_var($user->pihak_email, FILTER_VALIDATE_EMAIL) ? $user->pihak_email : uniqid('pihak_', true).'@mediasi.online',
                    'password' => Hash::make('mediasi'),
                    'status_id' => 2,
                ];
                })->toArray();

                DB::table('users')->upsert(
                    $data,
                    ['id'],
                    ['user_type', 'name', 'username', 'email', 'password', 'status_id']
                );
            });

            $this->data_mediator->chunk(200)->each(function($a){
                
            $user_mediator = $a->map(function($mediator){
                return [
                    'id' => $mediator->mediator_id,
                    'user_type' => 'mediator',
                    'name' => $mediator->nama_gelar,
                    'email' => uniqid('mediator_', true).'@mediasi.online',
                    'password' => Hash::make('mediasi'),
                    'status_id' => 2,
                ];
                })->toArray();

                DB::table('users')->upsert(
                    $user_mediator,
                    ['id'],
                    ['user_type', 'name', 'email', 'password', 'status_id']
                );
            });

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
