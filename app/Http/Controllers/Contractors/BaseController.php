<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\Controller;
use App\Http\Integrations\DaData\Connector as DaDataConnector;
use App\Services\Contractor\Service;
use Illuminate\Support\Facades\App;


/**
 * @OA\Info(
 *     title="User-Contractors Doc API",
 *     version="1.0.0",
 * ),
 *
 * @OA\PathItem(path="/api/"),
 *
 */

class BaseController extends Controller
{

    protected DaDataConnector $connector;

    public function __construct(
        protected Service $service,
    ) {
        $this->connector = App::get("dadata.connector");
    }

}
