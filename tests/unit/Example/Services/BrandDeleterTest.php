<?php

declare(strict_types=1);

namespace App\Tests\unit\Example\Services;


use App\ExampleDomain\Exceptions\BrandDeleterException;
use App\ExampleDomain\Repositories\BrandRepository;
use App\ExampleDomain\Services\BrandDeleter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

final class BrandDeleterTest extends KernelTestCase
{
    public function testBrandIsMissing()
    {
        $this->expectException(BrandDeleterException::class);
        $this->expectExceptionMessage("Brand is missing");

        self::bootKernel();
        $container = BrandDeleterTest::getContainer();

        $brandRepository = $this->createMock(BrandRepository::class);
        $brandRepository->expects(self::once())
            ->method('isExistByGuid')
            ->willReturn(false);
        $container->set(BrandRepository::class, $brandRepository);

        /** @var BrandDeleter $brandDeleter */
        $brandDeleter = $container->get(BrandDeleter::class);
        $brandDeleter->delete(Uuid::v4());
    }

}
