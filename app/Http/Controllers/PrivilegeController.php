<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class PrivilegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($app_id)
    {
        $current_app = App::find($app_id);
        
        if($current_app->slug == 'master_app'){
            $user_apps = User::with(['roles.app'])->get();

            return Inertia::render('Apps/Master/Privileges/Index', [
                'user_apps' => $user_apps
            ]); 

        }else{

            $user_apps = $current_app->users()->with(['roles.permissions' => function($query) use ($app_id){
                return $query->whereHas('roles', function($role) use ($app_id){
                    $role->where('app_id', $app_id);
                });
            }])
            ->get();

            return Inertia::render('Apps/Mediator/Privileges/Index', [
                'user_apps' => $user_apps
            ]);  
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
