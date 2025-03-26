<?php

namespace App\Services\Contractor;

use App\Http\DataObjects\ContractorDto;
use App\Http\DataObjects\ContractorSearchDTO;
use App\Http\Resources\ContractorResource;
use App\Models\Contractor;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class Service
{

    public function store(ContractorDto $data): ContractorResource
    {
        $contractor = Contractor::firstOrCreate([
            'inn' => $data->inn,
            'name' => $data->name,
            'ogrn' => $data->ogrn,
            'address' => $data->address,
        ]);
        $contractor->users()->syncWithoutDetaching(Auth::id());
        return new ContractorResource($contractor);
    }

    public function show(ContractorSearchDTO $data): ResourceCollection
    {
        $query = User::find(Auth::id())
            ->contractors()
            ->orderBy('id');

        if ($data->search) {
            $query = Contractor::search($data->search)
                ->whereIn('id', $query->get()->pluck('id'));
        }
        return ContractorResource::collection(
            $query->paginate(
                perPage: 4,
                page: $data->page
            )
        );
    }

}
