<?php

namespace App\Http\Requests\Contractor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class IndexRequest extends FormRequest
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
            'page' => 'required|integer',
            'search' => 'nullable|string|regex:/^[\d\s\p{L}\"\',]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'search.string' => '',
            'search.regex' => 'Поиск осуществляется либо по ИНН (10 цифр) либо по названию организации(буквенные символы, кавычки, запятая)'
        ];
    }

}
