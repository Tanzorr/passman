<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email'],
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'min:6', 'confirmed'];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['password'] = ['nullable', 'min:6', 'confirmed'];
        }

        return $rules;
    }

}
