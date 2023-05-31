<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'code' => ['required', "numeric", Rule::unique('users')->ignore(request()->id)],
            'fullname' => 'required|max:50',
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(request()->id)],
            'password' =>  'nullable|max:25|min:8',
            'phone_number' => ["required", "numeric", "regex:/^([0-9\s\-\+\(\)]*)$/", "min:9", Rule::unique('users')->ignore(request()->id)],
            'day_of_birth' => 'required|date|before:today|after:' . now()->subYears(100)->format('Y-m-d'),
            'address' => 'nullable|max:100',
            'department_id' => [
                'required', 'exists:departments,id,deleted_at,NULL',
            ],
            'level' => [
                'required', Rule::in(['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5']),
            ]
        ];
    }
}
