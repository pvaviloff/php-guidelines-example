<?php

declare(strict_types=1);

namespace App\Tests\unit\Example\ValueObjects;


use App\ExampleDomain\Exceptions\BrandUpdaterObjectException;
use App\ExampleDomain\ValueObjects\BrandUpdaterObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

final class BrandUpdaterObjectTest extends KernelTestCase
{
    public function testEmptyName()
    {
        $this->expectException(BrandUpdaterObjectException::class);
        $this->expectExceptionMessage("Name can't be bigger than 100");

        new BrandUpdaterObject(Uuid::v4(), "");
    }

    public function testBiggerName()
    {
        $this->expectException(BrandUpdaterObjectException::class);
        $this->expectExceptionMessage("Name can't be bigger than 100");

        new BrandUpdaterObject(
            Uuid::v4(),
            "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
        );
    }

}
