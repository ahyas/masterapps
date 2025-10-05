<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['app_id', 'name', 'slug'];

    public function app() {
        return $this->belongsTo(App::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'app_role_user')
                    ->withPivot('app_id')
                    ->withTimestamps();
    }
}
