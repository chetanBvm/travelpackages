<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelExperienceStoreRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
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
            'name.required' => 'The name is required and cannot be empty.',
            'name.max' => 'The name cannot exceed 255 characters.',

            'image.required' => 'An image is required ',
            'image.image' => 'The uploaded file must be an image (jpeg, png, jpg, gif, or svg).',
            'image.mimes' => 'The image must be one of the following types: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size must not exceed 2MB.',

            'description.required' => 'The description is required'
        ];
    }
}
