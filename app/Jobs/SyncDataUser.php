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
                return [
                    'user_id' => $user->pihak_id,
                    'user_type' => 'client', //pihak/client
                    'name' => $user->pihak_nama,
                    'username' => $user->pihak_nik,
                    'email' => $user->pihak_email,
                    'password' => Hash::make('mediasi'),
                    'status_id' => 2,
                ];
                })->toArray();

                DB::table('users')->upsert(
                    $data,
                    ['user_id', 'user_type'],
                    ['name', 'username', 'email', 'password', 'status_id']
                );
            });

            $this->data_mediator->chunk(200)->each(function($a){
                
            $user_mediator = $a->map(function($mediator){
                return [
                    'user_id' => $mediator->mediator_id,
                    'user_type' => 'vendor', //vendor/mediator
                    'name' => $mediator->nama_gelar,
                    'username' => uniqid('uxser_', true).'@mediasi.online',
                    'password' => Hash::make('mediasi'),
                    'status_id' => 2,
                ];
                })->toArray();

                DB::table('users')->upsert(
                    $user_mediator,
                    ['user_id', 'user_type'],
                    ['name', 'username', 'password', 'status_id']
                );
            });

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
