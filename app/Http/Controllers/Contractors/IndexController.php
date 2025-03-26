<?php

namespace App\Http\Controllers\Contractors;

use App\Http\DataObjects\ContractorSearchDTO;
use App\Http\Requests\Contractor\IndexRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexController extends BaseController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request): ResourceCollection
    {
        $data = ContractorSearchDTO::createFromRequest($request);

        return $this->service->show($data);
    }
}
