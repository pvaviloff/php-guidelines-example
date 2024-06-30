<?php

declare(strict_types=1);

namespace App\ExampleDomain\Aggregates;


final readonly class BrandListAggregate
{
    public function __construct(
        public BrandObjectCollection $brands,
        public int $count,
        public int $page,
        public int $limit,
    ) {}

}
