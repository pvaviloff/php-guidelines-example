<?php

declare(strict_types=1);

namespace App\ExampleDomain\Services;


use App\ExampleDomain\Exceptions\BrandDeleterException;
use App\ExampleDomain\Repositories\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

final readonly class BrandDeleter
{
    public function __construct(
        private BrandRepository $brandRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function delete(Uuid $guid): void
    {
        if (!$this->brandRepository->isExistByGuid($guid)) {
            throw new BrandDeleterException("Brand is missing");
        }

        $brand = $this->brandRepository->getByGuid($guid);

        $this->entityManager->remove($brand);
    }

}
