<?php

namespace App\Http\Requests;

use App\Models\Apointment;
use App\Models\User;
use App\Rules\HaveApointmentRule;
use App\Rules\QuantityLimitRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApointmentRequest extends FormRequest
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
        $count = Apointment::where('time', request()->time)->whereNot('status', 'Cancelled')->count();
        $customer = User::find(request()->customer_id);
        return [
            'code' => ['required', "numeric", Rule::unique('apointments')->ignore(request()->id)],
            'customer_id' => 'required|exists:users,id',
            'employee_id' => 'nullable|exists:users,id',
            'time' =>  [
                'required', 'date',
                'after_or_equal:today',
                'before_or_equal:' . date('Y-m-d', strtotime('+1 week')),
                new QuantityLimitRule($count),
                new HaveApointmentRule($customer->apointments()->whereDate('time', substr(request()->time, 0, 10))->count())
            ],
            'status' => [
                'required', Rule::in(['Completed', 'Confirmed', 'Cancelled', 'Missed']),
            ],
        ];
    }
    public function attributes()
    {
        return [
            'customer_id' => 'customer',
            'employee_id' => 'staff',
            'time' => 'time of apointment'
        ];
    }
}
