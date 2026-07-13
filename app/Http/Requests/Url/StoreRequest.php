<?php

namespace App\Http\Requests\Url;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url',
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => 'A URL deve ser informada.',
            'url.url' => 'URL inválida.'
        ];
    }
}
