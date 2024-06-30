<?php

declare(strict_types=1);

namespace App\ExampleInfrastructure\MessageHandlers;

use App\ExampleDomain\Services\BrandCreator;
use App\ExampleDomain\ValueObjects\BrandCreatorObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class BrandCreateHandler
{
    public function __construct(
        private BrandCreator $brandCreator,
        private EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(BrandCreatorObject $brandCreatorObject): void
    {
        $this->brandCreator->create($brandCreatorObject);
        $this->entityManager->flush();
    }

}
