<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

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

    /**
     * Runners subscribed in the race
     *
     * @return HasManyThrough
     * @var array
     */
    public function runnersResults()
    {
        return $this->hasManyThrough(RaceRunnerResult::class, RaceSubscription::class, "race_id", "race_subscription_id");
    }

    /**
     * Runners subscribed in the race that belongs to the first group
     *
     * @return Collection
     * @var array
     */
    public function runnersResultsWithRunnersOfFirstGroup()
    {
        return $this->runnersResults()->join("runner", function ($join) {
            $join->on("runner.id", "=", "race_subscription.runner_id")
                ->whereBetween("runner.birthdate", [
                Carbon::now()->subYears(25),
                Carbon::now()->subYears(18)
            ]);
        });
    }

    /**
     * Runners subscribed in the race that belongs to the second group
     *
     * @return Collection
     * @var array
     */
    public function runnersResultsWithRunnersOfSecondGroup()
    {
        return $this->runnersResults()->join("runner", function ($join) {
            $join->on("runner.id", "=", "race_subscription.runner_id")
                ->whereBetween("runner.birthdate", [
                Carbon::now()->subYears(35),
                Carbon::now()->subYears(25)
            ]);
        });
    }

    /**
     * Runners subscribed in the race that belongs to the third group
     *
     * @return Collection
     * @var array
     */
    public function runnersResultsWithRunnersOfThirdGroup()
    {
        return $this->runnersResults()->join("runner", function ($join) {
            $join->on("runner.id", "=", "race_subscription.runner_id")
                ->whereBetween("runner.birthdate", [
                Carbon::now()->subYears(45),
                Carbon::now()->subYears(35)
            ]);
        });
    }

    /**
     * Runners subscribed in the race that belongs to the fourth group
     *
     * @return Collection
     * @var array
     */
    public function runnersResultsWithRunnersOfFourthGroup()
    {
        return $this->runnersResults()->join("runner", function ($join) {
            $join->on("runner.id", "=", "race_subscription.runner_id")
                ->whereBetween("runner.birthdate", [
                Carbon::now()->subYears(55),
                Carbon::now()->subYears(45)
            ]);
        });
    }

    /**
     * Runners subscribed in the race that belongs to the fifth group
     *
     * @return Collection
     * @var array
     */
    public function runnersResultsWithRunnersOfFifthGroup()
    {
        return $this->runnersResults()->join("runner", function ($join) {
            $join->on("runner.id", "=", "race_subscription.runner_id")
                ->whereDate("runner.birthdate", "<", Carbon::now()->subYears(55));
        });
    }

    /**
     * Runners subscribed in the race that belongs to the fifth group
     *
     * @return Collection
     * @var array
     */
    public function runnersResultsGrouped()
    {
        return [
            $this->runnersResultsWithRunnersOfFirstGroup,
            $this->runnersResultsWithRunnersOfSecondGroup,
            $this->runnersResultsWithRunnersOfThirdGroup,
            $this->runnersResultsWithRunnersOfFourthGroup,
            $this->runnersResultsWithRunnersOfFifthGroup
        ];
    }
}
