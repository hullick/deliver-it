<?php

namespace Hullick\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Runner extends Model
{
    use HasFactory;
    
    /**
     * Runner's race subscriptions
     *
     * @return BelongsToMany
     * @var array
     */
    public function raceSubscriptions()
    {
        return $this->belongsToMany(RaceSubscription::class, "runner_id");
    }
    
    /**
     * Runner's races results
     *
     * @return RaceRunnerResult
     * @var array
     */
    public function racesResults()
    {
        return $this->hasManyThrough(RaceRunnerResult::class, RaceSubscription::class);
    }
    
    /**
     * Set and validate runner's birthday
     * 
     * @param Carbon $value
     */
    public function setBirthdayAttribute($value){
        
    }
}