<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'currentPass' => 'required|max:25|min:8',
            'newPass' => 'required|max:25|min:8',
            'confPass' => 'required|max:25|min:8|same:newPass'
        ];
    }
    public function attributes()
    {
        return [
            'currentPass' => 'current password',
            'newPass' => 'new password',
            'confPass' => 'confirm password'
        ];
    }
}
