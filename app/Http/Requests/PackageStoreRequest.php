<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageStoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packages')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })->ignore($this->route('package')),
            ],
            'description' => 'nullable|string',
            'days' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0|max:9999999',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'string',
            'destination_id' => 'string|exists:destinations,id',
            'sub_title' => 'nullable',
            'tax' => 'required|numeric|min:0|max:99',
            'tax_rate' => 'numeric',
            'total_price' => 'numeric',
            'packagetype_id' => 'required|string|exists:package_types,id',
            'accommodation' => 'required|string|min:1',
            'package_includes' => 'required|string|min:1',
            'min_age' => 'required|integer|lt:max_age',
            'max_age' => 'required|integer|gt:min_age',
            'inclusion' => 'required|string|min:1',
            'exclusion' => 'required|string|min:1',
            'itinerary' => 'required|string',
            'departure_month.*' => 'required',
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
            'name.required' => 'name is required.',
            'days.required' => 'days is required.',
            'tax.required' => 'tax is required.',
            'packagetype_id.required' => 'Please select the package type.',
            'accommodation.required' => 'Please provide the accommodation description',
            'package_includes.required' => 'Please provide the package includes.',  
            'inclusion.required' => 'Please provide the inclusion.', 
            'exclusion.required' => 'Please provide the exclusion.',
            'itinerary' => 'Please provide the itinerary.',
            'departure_month.required' => 'please select the at least one month.'
        ];
    }
}
