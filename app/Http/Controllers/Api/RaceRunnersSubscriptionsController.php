<?php
namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\RelationController;
use App\Models\RaceSubscription;
use Orion\Concerns\DisableAuthorization;
use App\Models\Race;

class RaceRunnersSubscriptionsController extends RelationController
{
    use DisableAuthorization;
    
    protected $model = Race::class;

    protected $relation = 'runnersSubscribed';
}
