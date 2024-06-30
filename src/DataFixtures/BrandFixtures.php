<?php

namespace App\DataFixtures;

use App\ExampleDomain\Entities\BrandEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist(new BrandEntity("brand name 1"));
        $manager->persist(new BrandEntity("brand name 2"));
        $manager->persist(new BrandEntity("brand name 3"));
        $manager->persist(new BrandEntity("brand name 4"));
        $manager->persist(new BrandEntity("brand name 5"));
        $manager->persist(new BrandEntity("brand name 6"));
        $manager->persist(new BrandEntity("brand name 7"));
        $manager->persist(new BrandEntity("brand name 8"));
        $manager->persist(new BrandEntity("brand name 9"));
        $manager->persist(new BrandEntity("brand name 10"));
        $manager->persist(new BrandEntity("brand name 11"));

        $manager->flush();
    }

}
