<?php

declare(strict_types=1);

namespace App\Tests\unit\Example\ValueObjects;


use App\ExampleDomain\Exceptions\BrandCreatorObjectException;
use App\ExampleDomain\ValueObjects\BrandCreatorObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class BrandCreatorObjectTest extends KernelTestCase
{
    public function testEmptyName()
    {
        $this->expectException(BrandCreatorObjectException::class);
        $this->expectExceptionMessage("Name can't be bigger than 100");

        new BrandCreatorObject("");
    }

    public function testBiggerName()
    {
        $this->expectException(BrandCreatorObjectException::class);
        $this->expectExceptionMessage("Name can't be bigger than 100");

        new BrandCreatorObject(
            "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
        );
    }

}
