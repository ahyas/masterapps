<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mediasi extends Model
{
    protected $connection = 'mediasiapp_conn';
    protected $table = 'mediasis';

    public function perkaras():HasOne{
        return $this->hasOne(Perkara::class);
    }
}
