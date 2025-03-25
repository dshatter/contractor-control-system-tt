<?php

namespace App\Http\DataObjects;

use Saloon\Contracts\DataObjects\WithResponse;
use Saloon\Traits\Responses\HasResponse;

final class ContractorDto implements WithResponse
{

    use HasResponse;

    public function __construct(
        public readonly string $inn,
        public readonly string $name,
        public readonly string $ogrn,
        public readonly string $address
    ) {}

}
