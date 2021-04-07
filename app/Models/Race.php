<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Race extends Model
{
    use HasFactory;

    protected $table = "race";

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime'
    ];

    /**
     * Runners subscribed in the race
     *
     * @return BelongsToMany
     * @var array
     */
    public function runnersSubscribed()
    {
        return $this->belongsToMany(Runner::class, "race_subscription", "race_id")
            ->using(RaceSubscription::class)
            ->withTimestamps();
    }
}
