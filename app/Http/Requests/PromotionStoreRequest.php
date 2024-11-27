<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionStoreRequest extends FormRequest
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
            'price' => 'required|numeric|min:0', // Added numeric and minimum validation for price
            'type' => 'required|string|max:100', // Added string validation and length limit for type
            'expiry_date' => 'required|date',
            'status' => 'string',
            'code' =>'required',
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
            'name.required' => 'The promotion name is required and cannot be left empty.',
            'name.string' => 'The promotion name must be a valid string.',
            'name.max' => 'The promotion name cannot exceed 255 characters.',

            'price.required' => 'The price of the promotion is required.',
            'price.numeric' => 'The price must be a valid numeric value.',
            'price.min' => 'The price must be at least 0.',

            'type.required' => 'The promotion type is required.',
            'type.string' => 'The promotion type must be a valid string.',
            'type.max' => 'The promotion type cannot exceed 100 characters.',

            'expiry_date' => 'The promotion expiry date is required.',
        ];
    }
}
