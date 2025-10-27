<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Perkara extends Model
{
    protected $connection = 'mediasiapp_conn';
    protected $table = 'perkaras';

    public function pihaks():BelongsToMany{
        return $this->belongsToMany(Pihak::class);
    }

    public function mediator():BelongsTo{
        return $this->belongsTo(Mediator::class);
    }

    public function mediasi():BelongsTo{
        return $this->belongsTo(Mediasi::class);
    }
}
