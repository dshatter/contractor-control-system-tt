<?php

namespace App\Http\Controllers\Contractors;

use App\Http\DataObjects\ContractorSearchDTO;
use App\Http\Requests\Contractor\IndexRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Annotations as OA;


/**
 * @OA\Get(
 *     path="/api/contractors",
 *     summary="Get contractors list",
 *     description="returns list of contractors linked with current user. Supports pagination and search",
 *     security={{"sanctum": {}}},
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         required=true,
 *         description="Pagination page number.",
 *         @OA\Schema(type="integer"),
 *     ),
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         required=false,
 *         description="Search string for filter counterparty. If null - all current user conterparties will returned.",
 *         @OA\Schema(
 *             type="string",
 *             pattern="/^[\d\\s\p{L}\',]+$/",
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *                 @OA\Property(property="data", type="array", @OA\Items(
 *                     @OA\Property(property="id", type="integer", description="Counterparty id"),
 *                     @OA\Property(property="inn", type="string", description="Counterparty INN"),
 *                     @OA\Property(property="name", type="string", description="name"),
 *                     @OA\Property(property="ogrn", type="string", description="OGRN"),
 *                     @OA\Property(property="address", type="string", description="Counterparty address"),
 *                 )),
 *                 @OA\Property(property="links", type="object",
 *                     @OA\Property(property="first", type="string", description="First page link"),
 *                     @OA\Property(property="last", type="string", description="Last page link"),
 *                     @OA\Property(property="prev", type="string", description="Previous page link"),
 *                     @OA\Property(property="next", type="string", description="Next page link"),
 *                 ),
 *                 @OA\Property(property="meta", type="object",
 *                         @OA\Property(property="current_page", type="integer", description="Current page"),
 *                         @OA\Property(property="from", type="integer", description="first element"),
 *                         @OA\Property(property="last_page", type="integer", description="Last page"),
 *                         @OA\Property(property="path", type="string", description="API path"),
 *                         @OA\Property(property="per_page", type="integer", description="page elements quantity"),
 *                         @OA\Property(property="to", type="integer", description="last element"),
 *                         @OA\Property(property="total", type="integer", description="total amount of elements"),
 *                         @OA\Property(property="links", type="array",
 *                     @OA\Items(type="object",
 *                         @OA\Property(property="url", type="string", description="Page link"),
 *                         @OA\Property(property="label", type="string", description="page label"),
 *                         @OA\Property(property="active", type="boolean", description="is page active"),
 *                     ),
 *                 ),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No data"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Contractors not found.",
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
 *         response=422,
 *         description="Unprocessible content.",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error.",
 *     ),
 * ),
 */
class IndexController extends BaseController
{

    public function __invoke(IndexRequest $request): ResourceCollection
    {
        $data = ContractorSearchDTO::createFromRequest($request);

        return $this->service->show($data);
    }

}
