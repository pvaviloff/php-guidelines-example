<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Responses;


use Symfony\Component\HttpFoundation\JsonResponse;

final class BrandUpdateResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct([
            "message" => "Brand updated successfully",
        ], self::HTTP_OK);
    }

}
