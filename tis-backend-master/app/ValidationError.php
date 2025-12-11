<?php

namespace App;

class ValidationError extends APIError
{
    public function __construct($code = 422, $message = 'Validation error', $errors = [])
    {
        parent::__construct($code, $message, $errors);
    }
}
