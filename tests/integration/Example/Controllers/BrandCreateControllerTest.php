<?php

declare(strict_types=1);

namespace App\Tests\integration\Example\Controllers;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BrandCreateControllerTest extends WebTestCase
{
    public function testIsSuccessful()
    {
        $client = BrandCreateControllerTest::createClient();
        $client->request('POST', "/api/brand", [
            'brand_name' => 'test' . rand(1, 20),
        ]);

        $this->assertResponseIsSuccessful();
    }

}
