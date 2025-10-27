<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UnAuthorizeException extends HttpException
{
    public function __construct(string $message = 'Unauthorized')
    {
        parent::__construct(Response::HTTP_UNAUTHORIZED, $message);
    }
}
