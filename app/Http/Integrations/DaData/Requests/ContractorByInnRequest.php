<?php

namespace App\Http\Integrations\DaData\Requests;

use App\Http\DataObjects\ContractorDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class ContractorByInnRequest extends Request implements HasBody
{

    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected array $payload
    ) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint($name = ""): string
    {
        return '/rs/findById/party';
    }

    /**
     * The body for the request
     */
    protected function defaultBody(): array
    {
        return $this->payload;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json()['suggestions'];
        if(empty($data))
            throw new \Exception('Контрагент не найден', 404);
        $data = $data[0]['data'];

        return new ContractorDto(
            inn: $data['inn'],
            name: $data['name']['short_with_opf'],
            ogrn: $data['ogrn'],
            address: $data['address']['unrestricted_value']
        );
    }

}
