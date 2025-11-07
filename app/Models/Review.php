<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'mediator_id',
        'user_id',
        'rating',
        'testimony',
    ];

    public function mediator(){
        return $this->belongsTo(Mediator::class);
    }

    public function perkara(){
        return $this->belongsTo(Perkara::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
