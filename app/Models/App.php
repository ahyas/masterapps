<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class App extends Model
{
    protected $fillable = ['name', 'slug'];

    public function roles() {
        return $this->hasMany(Role::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'app_role_user')
                    ->withPivot('role_id')
                    ->withTimestamps();
    }
}
