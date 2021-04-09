<?php
namespace App\Http\Controllers\Api;

use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use App\Models\Race;

class RaceController extends Controller
{
    use DisableAuthorization;

    /**
     * Model that Orion's controller manage.
     */
    protected $model = Race::class;
}
