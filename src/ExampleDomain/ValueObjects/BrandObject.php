<?php

declare(strict_types=1);

namespace App\ExampleDomain\ValueObjects;


use Symfony\Component\Uid\Uuid;

final readonly class BrandObject
{
    public function __construct(
        public Uuid $guid,
        public string $name,
    ) {}

}
