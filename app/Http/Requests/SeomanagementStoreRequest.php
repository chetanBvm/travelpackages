<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeomanagementStoreRequest extends FormRequest
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
            'page_id' =>'integer',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string',
            'title' => 'required|string',
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
            'meta_description.required' => 'The descripton field is required.',
            'meta_keywords.required' => 'The keyword field is required.',
            'title.required' => 'The title field is required.',
            'type.required' => 'The type field is required.',
        ];
    }
}
