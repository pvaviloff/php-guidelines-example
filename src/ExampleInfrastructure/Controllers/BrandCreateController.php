<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\Controllers;


use App\ExampleDomain\Exceptions\BrandCreatorException;
use App\ExampleDomain\Services\BrandCreator;
use App\ExampleDomain\ValueObjects\BrandCreatorObject;
use App\ExampleInfrastructure\Requests\BrandCreateRequest;
use App\ExampleInfrastructure\Responses\BrandCreateResponse;
use App\ExampleInfrastructure\Responses\ExceptionResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final class BrandCreateController
{
    #[Route(
        path: '/api/brand',
        name: 'Create brand',
        methods: ["POST"]
    )]
    public function __invoke(
        #[MapRequestPayload] BrandCreateRequest $request,
        BrandCreator $brandCreator,
        EntityManagerInterface $entityManager,
    ): JsonResponse
    {
        try {
            $brand = $brandCreator->create(new BrandCreatorObject($request->brandName));
        } catch (BrandCreatorException $exception) {

            return new ExceptionResponse($exception);
        }
        $entityManager->flush();

        return new BrandCreateResponse($brand->guid->toString());
    }

}
