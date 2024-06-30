<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Responses;


use Symfony\Component\HttpFoundation\JsonResponse;

final class BrandDeleteResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct([
            "message" => "Brand deleted successfully",
        ], self::HTTP_OK);
    }

}
