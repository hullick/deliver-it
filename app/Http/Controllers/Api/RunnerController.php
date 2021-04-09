<?php
namespace App\Http\Controllers\Api;

use App\Models\Runner;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;

class RunnerController extends Controller
{
    use DisableAuthorization;

    /**
     * Model that Orion's controller manage.
     */
    protected $model = Runner::class;
}
