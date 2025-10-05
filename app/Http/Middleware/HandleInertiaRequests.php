<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = User::find(Auth::user()?->id);
        $user_apps = $user?->apps->unique('slug')
        ->select('id','name', 'route_name', 'slug')
        ->where('id', $request->route('app_id'))
        ->first();

         //get current users access to each apps (role and permission)
        $app_role_permission = $request->route('app_id') ? $user->rolesForApp($request->route('app_id'))->loadMissing('permissions') : null;

        $permissions = $user->rolesForApp($request->route('app_id'))->loadMissing('permissions')
        ->flatMap(function ($data) {
            return $data->permissions;
        })->map(function ($permission) {
            return [
                $permission['slug'] => Auth::user()->can($permission['slug'])
            ];
        })->collapse()->all();
        
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'request' =>$request->route('app_id'),
                'user_apps' => $user_apps,
                'permissions' => $app_role_permission,
                'privilege' => $permissions
            ],
        ];
    }
}
