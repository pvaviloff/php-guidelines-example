<?php

declare(strict_types=1);

namespace App\ExampleDomain\ValueObjects;


use App\ExampleDomain\Constants\BrandConst;
use App\ExampleDomain\Exceptions\BrandUpdaterObjectException;
use Symfony\Component\Uid\Uuid;

final readonly class BrandUpdaterObject
{
    public function __construct(
        public Uuid $guid,
        public string $name,
    ) {
        $nameLength = strlen($name);
        if ($nameLength <= 0 || $nameLength > BrandConst::NAME_LENGTH) {
            throw new BrandUpdaterObjectException("Name can't be bigger than " . BrandConst::NAME_LENGTH);
        }
    }

}
