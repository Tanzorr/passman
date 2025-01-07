<?php

namespace App\Http\Requests;

use App\Models\MediaRelation;
use Illuminate\Foundation\Http\FormRequest;

class AttachMediaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'media_id' => [
                'required',
                'exists:media,id',
                function ($attribute, $value, $fail) {
                    if (MediaRelation::with('media')->where('media_id', $value)->exists()) {
                        $fail('This media is already attached to the entity.');
                    }
                },
            ],
            'entity_type' => 'required|string',
            'entity_id' => 'required|integer',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'media_id.required' => 'The media ID is required.',
            'media_id.exists' => 'The selected media does not exist.',
            'entity_type.required' => 'The entity type is required.',
            'entity_id.required' => 'The entity ID is required.',
        ];
    }
}
