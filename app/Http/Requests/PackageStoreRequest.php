<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'days' => 'required|numeric|min:0',
            'price' => 'numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'string',
            'destination_id' => 'string|exists:destinations,id',
            'sub_title' => 'required|string',
            'tax' => 'required|numeric|min:0',
            'tax_rate' => 'numeric',
            'total_price' => 'numeric',
            'packagetype_id' => 'required|string|exists:package_types,id',
            'accommodation' => 'required|string|min:1',
            'package_includes' => 'required|string|min:1',
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
            'sub_title.required' => 'Please enter the sub title.',
            'tax.required' => 'tax is required.',
            'packagetype_id.required' => 'Please select the package type.',
            'accommodation.required' => 'Please provide the accommodation description',
            'package_includes.required' => 'Please provide the package includes.',  
        ];
    }
}
