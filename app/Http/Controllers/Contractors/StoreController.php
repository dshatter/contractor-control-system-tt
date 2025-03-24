<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contractor\StoreRequest;
use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $contractor = Contractor::firstOrCreate([
            'inn' => $data['inn'],
            'name' => 'ИП Петров Иван Сергеевич',
            'ogrn' => '304231123456788',
            'address' => 'г. Краснодар, ул. Красная, д. 5'
        ]);

        $contractor->users()->syncWithoutDetaching(Auth::id());
        return response([Auth::id()]);
    }
}
