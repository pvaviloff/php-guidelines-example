<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Controllers;


use App\ExampleDomain\Services\BrandAggregator;
use App\ExampleDomain\ValueObjects\BrandListObject;
use App\ExampleInfrastructure\Responses\BrandsGetResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class BrandsGetController
{
    #[Route(
        path: '/api/brand/{limit}/{page}',
        name: 'Get brands',
        requirements: ['limit' => '[0-9]+', 'page' => '[0-9]+'],
        methods: ["GET"]
    )]
    public function __invoke(
        int $limit,
        int $page,
        BrandAggregator $brandAggregator,
    ): JsonResponse
    {

        return new BrandsGetResponse($brandAggregator->getList(new BrandListObject($limit, $page)));
    }

}
