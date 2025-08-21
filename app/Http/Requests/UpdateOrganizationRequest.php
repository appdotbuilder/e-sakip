<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:organizations,code,' . $this->route('organization')->id,
            'type' => 'required|in:regional_apparatus,district_government',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Organization name is required.',
            'code.required' => 'Organization code is required.',
            'code.unique' => 'This organization code is already taken by another organization.',
            'type.required' => 'Organization type is required.',
            'type.in' => 'Invalid organization type selected.',
        ];
    }
}