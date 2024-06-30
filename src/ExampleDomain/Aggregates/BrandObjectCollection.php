<?php

declare(strict_types=1);

namespace App\ExampleDomain\Aggregates;


use App\ExampleDomain\ValueObjects\BrandObject;
use Ramsey\Collection\AbstractCollection;

final class BrandObjectCollection extends AbstractCollection
{
    public function getType(): string
    {
        return BrandObject::class;
    }

}
