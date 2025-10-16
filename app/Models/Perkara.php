<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perkara extends Model
{
    protected $connection = 'mediasiapp_conn';

    public function pihaks():BelongsToMany{
        return $this->belongsToMany(Pihak::class);
    }
}
