<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StayStoreRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The stay name is required and cannot be empty.',
            'name.max' => 'The stay name cannot exceed 255 characters.',

            'image.required' => 'An image is required for the stay.',
            'image.image' => 'The uploaded file must be an image (jpeg, png, jpg, gif, or svg).',
            'image.mimes' => 'The image must be one of the following types: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }
}
