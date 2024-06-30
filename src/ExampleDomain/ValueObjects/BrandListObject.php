<?php

declare(strict_types=1);

namespace App\ExampleDomain\ValueObjects;


use App\ExampleDomain\Exceptions\BrandListObjectException;

final readonly class BrandListObject
{
    public function __construct(
        public int $limit,
        public int $page,
    ) {
        if ($limit <= 0) {
            throw new BrandListObjectException("Limit can't be less than 0");
        } elseif ($page <= 0) {
            throw new BrandListObjectException("Page can't be less than 0");
        }
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }

}
