<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RaceSubscription extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $hidden = [
        "created_at",
        "updated_at",
        "id",
        "runner_id",
        "race_id",
        "deleted_at"
    ];

    /**
     * Get the race from subscription.
     */
    public function race()
    {
        return $this->belongsTo(Race::class, 'race_id');
    }

    /**
     * Get the race from subscription.
     */
    public function runner()
    {
        return $this->belongsTo(Runner::class, 'runner_id');
    }

    /**
     * Runner result's associated race subscription
     *
     * @return HasOne
     */
    public function raceRunnerResult()
    {
        return $this->hasOne(RaceRunnerResult::class);
    }
}
