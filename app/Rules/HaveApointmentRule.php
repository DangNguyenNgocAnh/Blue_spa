<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class HaveApointmentRule implements Rule
{
    private $limit;
    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    public function passes($attribute, $value)
    {
        return $this->limit <= 3;
    }

    public function message()
    {
        return 'You have scheduled the maximum number of appointments for today.';
    }
}
