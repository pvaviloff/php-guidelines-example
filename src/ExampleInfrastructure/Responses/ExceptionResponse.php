<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Responses;


use Symfony\Component\HttpFoundation\JsonResponse;

final class ExceptionResponse extends JsonResponse
{
    public function __construct(\Throwable $exception)
    {
        parent::__construct([
            "message" => $exception->getMessage(),
        ], self::HTTP_INTERNAL_SERVER_ERROR);
    }

}
