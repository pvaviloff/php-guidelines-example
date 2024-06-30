<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Responses;


use App\ExampleDomain\Aggregates\BrandListAggregate;
use Symfony\Component\HttpFoundation\JsonResponse;

final class BrandsGetResponse extends JsonResponse
{
    public function __construct(BrandListAggregate $aggregate)
    {
        $response = [
            "data" => [],
            "count" => $aggregate->count,
            "page" => $aggregate->page,
            "limit" => $aggregate->limit,
        ];
        foreach ($aggregate->brands as $brand) {
            $response["data"][] = [
                "guid" => $brand->guid,
                "name" => $brand->name,
            ];
        }

        parent::__construct($response, self::HTTP_OK);
    }

}
