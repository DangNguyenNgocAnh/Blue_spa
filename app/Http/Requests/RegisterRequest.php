<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|max:50',
            'email' => ['required', 'email', 'max:50', Rule::unique('users')],
            'password' =>  'required|max:25|min:15',
            'confPass' => 'required|max:25|min:8|same:password',
            'phone_number' => ["required", "numeric", "regex:/^([0-9\s\-\+\(\)]*)$/", "min:9", Rule::unique('users')],
            'day_of_birth' => 'nullable|date|before:today|after:' . now()->subYears(100)->format('Y-m-d'),
            'address' => 'nullable|max:100',
        ];
    }
    public function attributes()
    {
        return [
            'confPass' => 'confirm password'
        ];
    }
}
