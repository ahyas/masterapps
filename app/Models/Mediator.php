<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mediator extends Model
{
    protected $connection = 'mediasiapp_conn';
    protected $table = 'mediators';
    protected $casts = [
        'reviews_sum_rating' => 'float', //convert string to number
        'total_reviews' => 'float',
        'length_review' => 'float'
    ];

    public function perkaras():HasMany{
        return $this->hasMany(Perkara::class);
    }

    public function reviews():HasMany{
        return $this->hasMany(Review::class);
    }

    public function averageRating(){
        return $this->reviews()->avg('rating');
    }

    public function mediasis(){
        return $this->hasMany(Mediasi::class);        
    }
}
