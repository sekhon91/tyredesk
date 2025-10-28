<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ForbiddenException extends HttpException
{
    public function __construct(string $message = 'Forbidden')
    {
        parent::__construct(Response::HTTP_FORBIDDEN, $message);
    }
}
