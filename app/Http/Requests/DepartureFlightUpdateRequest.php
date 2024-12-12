<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartureFlightUpdateRequest extends FormRequest
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
            'package_id' => 'required|exists:packages,id',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'year' => 'required|string',
            'price' => 'nullable',
            'status' => 'string|in:Active,InActive,Sold Out'
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
            'package_id.required' => 'package name is required',
            'departure_date.required' => 'departure date is required',
            'return_date.required' => 'return date is required',
            'year.required' => 'year is required.',
            // 'price.required' => 'price is required.',
        ];
    }
}
