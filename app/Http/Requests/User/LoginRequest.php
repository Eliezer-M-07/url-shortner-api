<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email deve ser informado.',
            'email.email' => 'O email deve ser válido.',

            'password.required' => 'A senha deve ser informada.',
            'password.string' => 'A senha deve ser do tipo texto.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ];
    }
}
