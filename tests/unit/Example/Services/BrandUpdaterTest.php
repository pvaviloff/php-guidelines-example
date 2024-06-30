<?php

declare(strict_types=1);

namespace App\Tests\unit\Example\Services;


use App\ExampleDomain\Exceptions\BrandUpdaterException;
use App\ExampleDomain\Repositories\BrandRepository;
use App\ExampleDomain\Services\BrandUpdater;
use App\ExampleDomain\ValueObjects\BrandUpdaterObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

final class BrandUpdaterTest extends KernelTestCase
{
    public function testBrandIsMissing()
    {
        $this->expectException(BrandUpdaterException::class);
        $this->expectExceptionMessage("Brand is missing");

        self::bootKernel();
        $container = BrandUpdaterTest::getContainer();

        $brandRepository = $this->createMock(BrandRepository::class);
        $brandRepository->expects(self::once())
            ->method('isExistByGuid')
            ->willReturn(false);
        $container->set(BrandRepository::class, $brandRepository);

        /** @var BrandUpdater $brandUpdater */
        $brandUpdater = $container->get(BrandUpdater::class);
        $brandUpdater->update(new BrandUpdaterObject(Uuid::v4(), "BrandIsMissing"));
    }

    public function testBrandNameAlreadyExists()
    {
        $this->expectException(BrandUpdaterException::class);
        $this->expectExceptionMessage("Brand name already exists");

        self::bootKernel();
        $container = BrandUpdaterTest::getContainer();

        $brandRepository = $this->createMock(BrandRepository::class);
        $brandRepository->expects(self::once())
            ->method('isExistByGuid')
            ->willReturn(true);
        $brandRepository->method('isExistByName')
            ->willReturn(true);
        $container->set(BrandRepository::class, $brandRepository);

        /** @var BrandUpdater $brandUpdater */
        $brandUpdater = $container->get(BrandUpdater::class);
        $brandUpdater->update(new BrandUpdaterObject(Uuid::v4(), "BrandNameAlreadyExists"));
    }

}
