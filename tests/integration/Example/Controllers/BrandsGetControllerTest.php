<?php

declare(strict_types=1);

namespace App\Tests\integration\Example\Controllers;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BrandsGetControllerTest extends WebTestCase
{
    public function testIsSuccessful()
    {
        $client = BrandsGetControllerTest::createClient();
        $client->request('GET', "/api/brand/10/1");

        $this->assertResponseIsSuccessful();
    }

}
