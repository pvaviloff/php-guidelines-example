<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Controllers;


use App\ExampleDomain\Exceptions\BrandAggregatorException;
use App\ExampleDomain\Services\BrandAggregator;
use App\ExampleInfrastructure\Responses\BrandGetResponse;
use App\ExampleInfrastructure\Responses\ExceptionResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class BrandGetController
{
    #[Route(
        path: '/api/brand/{guid}',
        name: 'Get brand',
        requirements: ['guid' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'],
        methods: ["GET"]
    )]
    public function __invoke(
        string $guid,
        BrandAggregator $brandAggregator,
    ): JsonResponse
    {
        try {
            $brand = $brandAggregator->getByGuid(Uuid::fromString($guid));
        } catch (BrandAggregatorException $exception) {

            return new ExceptionResponse($exception);
        }

        return new BrandGetResponse($brand);
    }

}
