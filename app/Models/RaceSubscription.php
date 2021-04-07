<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RaceSubscription extends Pivot
{
    use HasFactory;
    
    /**
     * Get the race from subscription.
     */
    public function race()
    {
       return $this->belongsTo(Race::class, 'race_id');
    }
}
