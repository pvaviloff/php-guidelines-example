<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Controllers;


use App\ExampleDomain\Exceptions\BrandUpdaterException;
use App\ExampleDomain\Services\BrandUpdater;
use App\ExampleDomain\ValueObjects\BrandUpdaterObject;
use App\ExampleInfrastructure\Requests\BrandUpdateRequest;
use App\ExampleInfrastructure\Responses\BrandUpdateResponse;
use App\ExampleInfrastructure\Responses\ExceptionResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class BrandUpdateController
{
    #[Route(
        path: '/api/brand/{guid}',
        name: 'Update brand',
        requirements: ['guid' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}'],
        methods: ["PUT"]
    )]
    public function __invoke(
        string $guid,
        #[MapRequestPayload] BrandUpdateRequest $request,
        BrandUpdater $brandUpdater,
        EntityManagerInterface $entityManager,
    ): JsonResponse
    {
        try {
            $brandUpdater->update(new BrandUpdaterObject(Uuid::fromString($guid), $request->brandName));
        } catch (BrandUpdaterException $exception) {

            return new ExceptionResponse($exception);
        }
        $entityManager->flush();

        return new BrandUpdateResponse();
    }

}
