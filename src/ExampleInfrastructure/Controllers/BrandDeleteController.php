<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Controllers;


use App\ExampleDomain\Exceptions\BrandDeleterException;
use App\ExampleDomain\Services\BrandDeleter;
use App\ExampleInfrastructure\Responses\BrandDeleteResponse;
use App\ExampleInfrastructure\Responses\ExceptionResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class BrandDeleteController
{
    #[Route(
        path: '/api/brand/{guid}',
        name: 'Delete brand',
        requirements: ['guid' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'],
        methods: ["DELETE"]
    )]
    public function __invoke(
        string $guid,
        BrandDeleter $brandDeleter,
        EntityManagerInterface $entityManager,
    ): JsonResponse
    {
        try {
            $brandDeleter->delete(Uuid::fromString($guid));
        } catch (BrandDeleterException $exception) {

            return new ExceptionResponse($exception);
        }
        $entityManager->flush();

        return new BrandDeleteResponse();
    }

}
