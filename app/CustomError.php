<?php

namespace App;

use App\APIError;

class CustomError extends APIError
{
    public function __construct($code = 400, $message = 'Ошибка', $errors = [])
    {
        parent::__construct($code, $message, $errors);
    }
}
