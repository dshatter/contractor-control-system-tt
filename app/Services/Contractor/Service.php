<?php

namespace App\Services\Contractor;

use App\Http\DataObjects\ContractorDto;
use App\Http\Resources\ContractorResource;
use App\Models\Contractor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Service
{

    public function store(ContractorDto $data)
    {
        $contractor = Contractor::firstOrCreate([
            'inn' => $data->inn,
            'name' => $data->name,
            'ogrn' => $data->ogrn,
            'address' => $data->address
        ]);
        $contractor->users()->syncWithoutDetaching(Auth::id());
        return new ContractorResource($contractor);
    }

    public function show()
    {
        return ContractorResource::collection(
            User::find(Auth::id())
                ->contractors()
                ->orderBy('name')
                ->get()
        );
    }

}
