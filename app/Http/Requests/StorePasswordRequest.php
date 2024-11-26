<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePasswordRequest extends FormRequest
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
        return [
            'vault_id' => [
                'required',
                'integer',
                'exists:vaults,id',
            ],
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                Rule::unique('passwords')->where(function ($query) {
                    return $query->where('vault_id', $this->vault_id);
                }),
            ],
            'value' => [
                'required',
                'string',
                'min:4',
            ],
            'description' => [
                'nullable', // Поле не є обов'язковим.
                'string', // Якщо передане, воно повинно бути рядком.
                'max:1000', // Максимальна довжина (за бажанням).
            ],
        ];
    }
}
