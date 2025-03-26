<?php

namespace App\Http\DataObjects;

use Illuminate\Http\Request;

use function Laravel\Prompts\search;

final class ContractorSearchDTO
{

    private function __construct(
        public readonly string $search,
        public readonly int $page
    ) {}

    public static function createFromRequest(Request $request): static
    {
        $data = $request->validated();
        return new static(
            search: $data['search'] ?? '',
            page: $data['page'] ?? ''
        );
    }

}
