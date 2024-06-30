<?php

declare(strict_types=1);

namespace App\ExampleDomain\ValueObjects;


use App\ExampleDomain\Constants\BrandConst;
use App\ExampleDomain\Exceptions\BrandCreatorObjectException;

final readonly class BrandCreatorObject
{
    public function __construct(
        public string $name,
    ) {
        $nameLength = strlen($name);
        if ($nameLength <= 0 || $nameLength > BrandConst::NAME_LENGTH) {
            throw new BrandCreatorObjectException("Name can't be bigger than " . BrandConst::NAME_LENGTH);
        }
    }

}
