<?php

namespace App\Http\Controllers;

use App\Jobs\SyncDataSIPPJob;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class SinkronController extends Controller
{
    public function index(){
        return Inertia::render('Apps/Master/Sinkron/Index');
    }

    public function fetch_data($app_id){
        SyncDataSIPPJob::dispatch();

        return response()->json(['message' => 'Sync job queued successfully!']);
    }
}
