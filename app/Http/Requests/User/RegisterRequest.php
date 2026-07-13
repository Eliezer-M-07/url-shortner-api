<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome deve ser informado.',
            'name.string' => 'O nome deve ser do tipo texto.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',

            'email.required' => 'O email deve ser informado.',
            'email.email' => 'O email deve ser válido.',
            'email.max' => 'O email não pode ter mais que 255 caracteres.',
            'email.unique' => 'O email já foi cadastrado.',

            'password.required' => 'A senha deve ser informada.',
            'password.string' => 'A senha deve ser do tipo texto.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas devem coincidir.'
        ];
    }
}
