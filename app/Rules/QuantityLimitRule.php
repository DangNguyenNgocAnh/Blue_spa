<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class QuantityLimitRule implements Rule
{
    private $limit;
    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    public function passes($attribute, $value)
    {
        return $this->limit <= 10;
    }

    public function message()
    {
        return 'The maximum number of registrations has been reached at this time.';
    }
}
