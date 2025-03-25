<?php

namespace App\Http\Controllers\Contractors;

class ShowController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return $this->service->show();
    }
}
