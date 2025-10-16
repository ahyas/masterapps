<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pihak extends Model
{
    protected $connection = 'mediasiapp_conn';
    
    public function perkaras():BelongsToMany{
        return $this->belongsToMany(Perkara::class);
    }
}
