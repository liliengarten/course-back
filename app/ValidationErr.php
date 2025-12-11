<?php

namespace App;
use Illuminate\Contracts\Validation\Validator;
trait ValidationErr
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationError(code: 422, message: 'Validation error', errors: [$validator->errors()->toArray()]);
    }
}
