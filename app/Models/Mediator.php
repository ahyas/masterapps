<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mediator extends Model
{
    protected $connection = 'mediasiapp_conn';
    protected $table = 'mediators';

    public function perkaras():HasMany{
        return $this->hasMany(Perkara::class);
    }

    public function reviews():HasMany{
        return $this->hasMany(Review::class);
    }

    public function averageRating(){
        return $this->reviews()->avg('rating');
    }
}
