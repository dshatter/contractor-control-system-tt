<?php

namespace App\Http\Requests\Contractor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'inn' => 'required|string|regex:/^\d{10}$/',
        ];
    }

    public function messages()
    {
        return [
            'inn.required' => 'Поле ИНН обязательно для заполнения',
            'inn.string' => 'Поле ИНН должно быть строкой и состоять из цифр',
            'inn.regex' => 'Поле ИНН должно содержать ровно 10 цифр',
        ];
    }

}
