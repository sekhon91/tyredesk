<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NotFoundException extends HttpException
{
    public function __construct(string $message = 'Resource not found.')
    {
        parent::__construct(Response::HTTP_NOT_FOUND, $message);
    }
}
