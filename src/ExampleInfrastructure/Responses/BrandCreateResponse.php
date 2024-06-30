<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Responses;


use Symfony\Component\HttpFoundation\JsonResponse;

final class BrandCreateResponse extends JsonResponse
{
    public function __construct(string $guid)
    {
        parent::__construct([
            "message" => "Brand created successfully",
            "guid" => $guid,
        ], self::HTTP_OK);
    }

}
