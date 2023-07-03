<?php

namespace App\Http\Requests;

use App\Models\Apointment;
use App\Models\User;
use App\Rules\HaveApointmentRule;
use App\Rules\QuantityLimitRule;
use DateTime;
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
        $apointment_time = (request()->minute)
            ? DateTime::createFromFormat('Y-m-d H:i', "request()->date request()->hour:request()->minute")
            : DateTime::createFromFormat('Y-m-d H:i', "request()->date request()->hour:00");
        $customer = User::find(request()->customer_id);
        if (request()->date == now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')) {
            $rule_hour =  [
                'required', 'date_format:H',
                'after:' . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H')
            ];
        } else {
            $rule_hour =  ['required'];
        }

        if ($customer) {
            $rule_date = [
                'required',
                new QuantityLimitRule(Apointment::where('time', $apointment_time)->count()),
                new HaveApointmentRule($customer->apointments()->whereDate('time', request()->date)->whereNot('status', 'Cancelled')->count())
            ];
        } else $rule_date = ['required'];
        return [
            'code' => ['nullable', "numeric", Rule::unique('apointments')->ignore(request()->id)],
            'customer_id' => 'required|exists:users,id',
            'employee_id' => 'nullable|exists:users,id',
            'status' => [
                'nullable', Rule::in(['Completed', 'Confirmed', 'Cancelled', 'Missed']),
            ],
            'hour' => $rule_hour,
            'date' => $rule_date
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
    public function messages()
    {
        return [
            'hour.after' => 'The hour must be after the current time'
        ];
    }
}
