<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100',  Rule::unique('packages')->ignore($this->package)],
            'price' => ['required', 'numeric', 'min:10000'],
            'code' => ['required', 'numeric', Rule::unique('packages')->ignore($this->package)],
            'status' => ['nullable', Rule::in(['Coming', 'Closed', 'Pending'])],
            'types' => ['nullable', Rule::in(['Basic', 'Standard', 'Premium', 'Trial', 'Special'])],
            'description' => 'nullable|max:255',
            'category_id' => [
                'required', 'exists:categories,id,deleted_at,NULL',
            ],
        ];
    }
    public function attributes()
    {
        return [
            'category_id' => 'category'
        ];
    }
}
