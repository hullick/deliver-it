<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use App\Exceptions\RaceRunnerResultStartDatetimeBeforeRaceDate;
use App\Exceptions\RaceRunnerResultFinishTimeBeforeStartTime;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RaceRunnerResult extends Model
{
    use HasFactory;

    protected $table = "race_runner_result";
    
    /**
     * Runner result's associated race subscription
     *
     * @return HasOneThrough
     *
     */
    public function raceSubscription()
    {
        return $this->belongsTo(RaceSubscription::class);
    }

    /**
     * Set and validate race runner result's start time
     *
     * @param \DateTime $value
     */
    public function setStartTimeAttribute($value)
    {
        // Check if the race date time is greater than the value to be set
        if (Carbon::parse($this->raceSubscription->race->getAttribute("date"))->gt($value)) {
            throw new RaceRunnerResultStartDatetimeBeforeRaceDate();
        } else {
            $this->attributes["start_time"] = $value;
        }
    }

    /**
     * Set and validate race runner result's finish time
     *
     * @param \DateTime $value
     */
    public function setFinishTimeAttribute($value)
    {
        // Check if the start time is greater than the value to be set
        if (Carbon::parse($this->getAttribute("start_time"))->gt($value)) {
            throw new RaceRunnerResultFinishTimeBeforeStartTime();
        } else {
            $this->attributes["finish_time"] = $value;
        }
    }
}
