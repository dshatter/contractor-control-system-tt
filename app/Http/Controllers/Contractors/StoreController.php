<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Requests\Contractor\StoreRequest;

/**
 * @OA\Post(
 *     path="/api/contractors",
 *     summary="Create counterparty for user",
 *     description="find counterparty through the DaData service and store it in database",
 *     security={{"sanctum": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="inn",
 *                 type="string",
 *                 description="Код ИНН для поиска контрагента на платформе.",
 *                 example="1234567890",
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Contractor not found.",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessible content.",
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated.",
 *     ),
 *     @OA\Response(
 *         response=419,
 *         description="Unauthenticated.",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error.",
 *     ),
 * ),
 */
class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $result = $this->connector->getContractorByInn($data['inn']);

        $this->service->store($result);
        return response([]);
    }

}
