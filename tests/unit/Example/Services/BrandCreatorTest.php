<?php

declare(strict_types=1);

namespace App\Tests\unit\Example\Services;


use App\ExampleDomain\Exceptions\BrandCreatorException;
use App\ExampleDomain\Repositories\BrandRepository;
use App\ExampleDomain\Services\BrandCreator;
use App\ExampleDomain\ValueObjects\BrandCreatorObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class BrandCreatorTest extends KernelTestCase
{
    public function testIsBrandExist()
    {
        $this->expectException(BrandCreatorException::class);
        $this->expectExceptionMessage("Brand exist");

        self::bootKernel();
        $container = BrandCreatorTest::getContainer();

        $brandRepository = $this->createMock(BrandRepository::class);
        $brandRepository->expects(self::once())
            ->method('isExistByName')
            ->willReturn(true);
        $container->set(BrandRepository::class, $brandRepository);

        /** @var BrandCreator $brandCreator */
        $brandCreator = $container->get(BrandCreator::class);
        $brandCreator->create(new BrandCreatorObject("IsBrandExist"));
    }

}
