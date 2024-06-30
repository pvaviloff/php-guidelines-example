<?php

declare(strict_types=1);

namespace App\ExampleDomain\Services;


use App\ExampleDomain\Entities\BrandEntity;
use App\ExampleDomain\Exceptions\BrandCreatorException;
use App\ExampleDomain\Repositories\BrandRepository;
use App\ExampleDomain\ValueObjects\BrandCreatorObject;
use Doctrine\ORM\EntityManagerInterface;

final readonly class BrandCreator
{
    public function __construct(
        private BrandRepository $brandRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function create(BrandCreatorObject $brandCreatorObject): BrandEntity
    {
        if ($this->brandRepository->isExistByName($brandCreatorObject->name)) {
            throw new BrandCreatorException("Brand exist");
        }
        $brand = new BrandEntity($brandCreatorObject->name);
        $this->entityManager->persist($brand);

        return $brand;
    }

}
