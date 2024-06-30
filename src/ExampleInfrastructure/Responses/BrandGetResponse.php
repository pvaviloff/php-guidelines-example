<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Responses;


use App\ExampleDomain\Entities\BrandEntity;
use Symfony\Component\HttpFoundation\JsonResponse;

final class BrandGetResponse extends JsonResponse
{
    public function __construct(BrandEntity $brand)
    {
        parent::__construct([
            "guid" => $brand->guid->toString(),
            "name" => $brand->name,
        ], self::HTTP_OK);
    }

}
