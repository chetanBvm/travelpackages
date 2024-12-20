<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageReviewStoreRequest extends FormRequest
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
            'package_id' => 'required|string',
            'name' => 'required|string',
            'description' =>  'required|string',
            'images' =>  'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'string',
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
            'package_id.required' => 'Package name is required.Please select the package',
            'name.required' => 'name is required.',
            'description.required' => 'description is required.',
        ];
    }
}
