<?php

namespace App\Http\Requests\Url;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('url'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'original_url' => 'required|url',
        ];
    }
    
    public function messages(): array
    {
        return [
            'original_url.required' => 'A URL deve ser informada.',
            'original_url.url' => 'URL inválida.'
        ];
    }
}
