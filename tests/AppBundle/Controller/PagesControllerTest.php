<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pages/company/', [
            'company' => 'Some Company',
            'json' => 'some-company.json',
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('Some Company', $crawler->filter('#company')->text());
    }
}
