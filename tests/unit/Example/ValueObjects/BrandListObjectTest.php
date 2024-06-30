<?php

declare(strict_types=1);

namespace App\Tests\unit\Example\ValueObjects;


use App\ExampleDomain\Exceptions\BrandListObjectException;
use App\ExampleDomain\ValueObjects\BrandListObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class BrandListObjectTest extends KernelTestCase
{
    public function testNegativeLimit()
    {
        $this->expectException(BrandListObjectException::class);
        $this->expectExceptionMessage("Limit can't be less than 0");

        new BrandListObject(-1, 2);
    }

    public function testZeroLimit()
    {
        $this->expectException(BrandListObjectException::class);
        $this->expectExceptionMessage("Limit can't be less than 0");

        new BrandListObject(0, 2);
    }

    public function testNegativePage()
    {
        $this->expectException(BrandListObjectException::class);
        $this->expectExceptionMessage("Page can't be less than 0");

        new BrandListObject(2, -1);
    }

    public function testZeroPage()
    {
        $this->expectException(BrandListObjectException::class);
        $this->expectExceptionMessage("Page can't be less than 0");

        new BrandListObject(2, 0);
    }

}
