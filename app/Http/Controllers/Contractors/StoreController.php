<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Requests\Contractor\StoreRequest;

class StoreController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $result = $this->connector->getContractorByInn($data['inn']);

        $this->service->store($result);
        return response([]);
    }
}
