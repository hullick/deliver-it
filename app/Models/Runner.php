<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;
use App\Exceptions\RunnerUnderAgeException;

class Runner extends Model
{
    use HasFactory;

    protected $table = "runner";

    protected $casts = [
        'birthday' => 'datetime'
    ];

    protected $fillable = [
        "name"
    ];

    /**
     * Runner's race subscriptions
     *
     * @return BelongsToMany
     * @var array
     */
    public function raceSubscriptions()
    {
        return $this->belongsToMany(Race::class, "race_subscription", "runner_id")
            ->using(RaceSubscription::class)
            ->withTimestamps();
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
    public function setBirthdateAttribute($value)
    {
        if (Carbon::now()->diffInYears($value) < 18) {
            throw new RunnerUnderAgeException();
        } else {
            $this->attributes["birthdate"] = $value;
        }
    }
}