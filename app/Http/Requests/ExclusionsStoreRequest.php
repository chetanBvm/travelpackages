<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExclusionsStoreRequest extends FormRequest
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
            'type' => 'string',
            'name' => 'required|string',
            'description' => 'required',
            'package_id' => 'required|exists:packages,id',
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
            'package_id.required' => 'Please select package',
            'description.required' => 'description is required',
            'name.required' => 'name is required',
        ];
    }
}
