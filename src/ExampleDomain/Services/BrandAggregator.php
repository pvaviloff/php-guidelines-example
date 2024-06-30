<?php

declare(strict_types=1);

namespace App\ExampleDomain\Services;


use App\ExampleDomain\Aggregates\BrandListAggregate;
use App\ExampleDomain\Aggregates\BrandObjectCollection;
use App\ExampleDomain\Entities\BrandEntity;
use App\ExampleDomain\Exceptions\BrandAggregatorException;
use App\ExampleDomain\Repositories\BrandRepository;
use App\ExampleDomain\ValueObjects\BrandListObject;
use Symfony\Component\Uid\Uuid;

final readonly class BrandAggregator
{
    public function __construct(
        private BrandRepository $brandRepository,
    ) {}

    public function getByGuid(Uuid $guid): BrandEntity
    {
        if (!$this->brandRepository->isExistByGuid($guid)) {
            throw new BrandAggregatorException("Brand is missing");
        }

        return $this->brandRepository->getByGuid($guid);
    }

    public function getList(BrandListObject $listObject): BrandListAggregate
    {
        $brands = new BrandObjectCollection();
        foreach ($this->brandRepository->getList($listObject) as $brand) {
            $brands->add($brand);
        }

        return new BrandListAggregate(
            $brands,
            $this->brandRepository->getCount(),
            $listObject->page,
            $listObject->limit,
        );
    }

}
