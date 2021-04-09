<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;
use App\Http\Controllers\Api\RunnerController;
use App\Http\Controllers\Api\RaceController;
use App\Http\Controllers\Api\RaceRunnersSubscriptionsController;
use App\Models\Race;
use Illuminate\Http\JsonResponse;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'as' => 'api.'
], function () {
    Orion::resource('runners', RunnerController::class)->withSoftDeletes();
    Orion::resource('races', RaceController::class)->withSoftDeletes();
    Orion::belongsToManyResource('race', 'runners-subscribed', RaceRunnersSubscriptionsController::class)->withSoftDeletes();

    Route::get('/race/{id}/grouped-results', function ($id) {
        $groupedResult = [
            "18-25" => Race::findOrFail($id)->runnersResultsWithRunnersOfFirstGroup()
                ->orderBy("finish_time", "asc")
                ->get(),
            "25-35" => Race::findOrFail($id)->runnersResultsWithRunnersOfSecondGroup()
                ->orderBy("finish_time", "asc")
                ->get(),
            "35-45" => Race::findOrFail($id)->runnersResultsWithRunnersOfThirdGroup()
                ->orderBy("finish_time", "asc")
                ->get(),
            "45-55" => Race::findOrFail($id)->runnersResultsWithRunnersOfFourthGroup()
                ->orderBy("finish_time", "asc")
                ->get(),
            "55+" => Race::findOrFail($id)->runnersResultsWithRunnersOfFifthGroup()
                ->orderBy("finish_time", "asc")
                ->get()
        ];

        foreach ($groupedResult as $group) {
            foreach ($group as $result) {
                $result->raceSubscription->race;
                $result->raceSubscription->runner;
            }
        }

        return JsonResponse::create([
            "data" => $groupedResult
        ]);
    });

    Route::get('/race/{id}/results', function ($id) {
        $results = Race::findOrFail($id)->runnersResults()
            ->orderBy("finish_time", "asc")
            ->get();

        foreach ($results as $result) {
            $result->raceSubscription->race;
            $result->raceSubscription->runner;
        }

        return JsonResponse::create([
            "data" => $results
        ]);
    });
});