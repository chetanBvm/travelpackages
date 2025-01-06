<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
    public function rules(Request $request): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packages')->where(function ($query) use ($request) {
                    return $query->where('destination_id', $request->input('destination_id'))
                                 ->whereNull('deleted_at');
                })->ignore($this->route('package')),
            ],
            'description' => 'nullable|string',
            'days' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0|max:9999999',
            'images.*' => 'nullable',
            'status' => 'string',
            'destination_id' => 'string',
            'sub_title' => 'nullable',
            'tax' => 'required|numeric|min:0|max:99',
            'tax_rate' => 'numeric',
            'total_price' => 'numeric',
            'packagetype_id' => 'required|string|exists:package_types,id',
            'accommodation' => 'required|string|min:1',
            'package_includes' => 'required|string|min:1',
            'min_age' => 'required|integer|lt:max_age|min:5|max:99',
            'max_age' => 'required|integer|gt:min_age|max:99',
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
            'name.unique' => 'Package name already exists. Please create another package.',
            'days.required' => 'days is required.',
            'tax.required' => 'tax is required.',
            'packagetype_id.required' => 'Please select the package type.',
            'accommodation.required' => 'Please provide the accommodation description',
            'package_includes.required' => 'Please provide the package includes.',  
            'inclusion.required' => 'Please provide the inclusion.', 
            'exclusion.required' => 'Please provide the exclusion.',
            'itinerary.required' => 'Please provide the itinerary.',
            'departure_month.required' => 'please select the at least one month.',
            'min_age.required' => 'The minimum age required.',
            'max_age.required' => 'The maximum age required.',
            'destination_id.required' => 'Please select a valid destination.',
        ];
    }
}
