<?php

declare(strict_types=1);

namespace App\ExampleDomain\Services;


use App\ExampleDomain\Exceptions\BrandUpdaterException;
use App\ExampleDomain\Repositories\BrandRepository;
use App\ExampleDomain\ValueObjects\BrandUpdaterObject;
use Doctrine\ORM\EntityManagerInterface;

final readonly class BrandUpdater
{
    public function __construct(
        private BrandRepository $brandRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function update(BrandUpdaterObject $brandUpdaterObject): void
    {
        if (!$this->brandRepository->isExistByGuid($brandUpdaterObject->guid)) {
            throw new BrandUpdaterException("Brand is missing");
        } elseif ($this->brandRepository->isExistByName($brandUpdaterObject->name)) {
            throw new BrandUpdaterException("Brand name already exists");
        }

        $brand = $this->brandRepository->getByGuid($brandUpdaterObject->guid);
        $brand->name = $brandUpdaterObject->name;

        $this->entityManager->persist($brand);
    }

}
