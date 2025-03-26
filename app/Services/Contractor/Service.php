<?php

namespace App\Services\Contractor;

use App\Exceptions\ApplicationException;
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
        if (!$contractor) {
            throw ApplicationException::init('Не удалось добавить контрагента');
        }
        return new ContractorResource($contractor);
    }

    public function show(ContractorSearchDTO $data): ResourceCollection
    {
        $query = User::find(Auth::id())->contractors();

        if (!$query->exists()) {
            throw ApplicationException::init('Контрагенты ещё не добавлены', 204);
        }

        if ($data->search) {
            $linkedIds = $query->get()->pluck('id');
            $query = Contractor::search($data->search)
                ->whereIn('id', $linkedIds);

            $result = $query->paginate(
                perPage: $data->countPerPage,
                page: $data->page
            );

            if (empty($result['items'])) {
                throw ApplicationException::notFound();
            }

            return ContractorResource::collection($result);
        }

        return ContractorResource::collection(
            $query->paginate(
                perPage: $data->countPerPage,
                page: $data->page
            )
        );
    }

}
