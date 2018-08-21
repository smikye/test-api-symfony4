<?php

namespace Tests\APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testProductionCapacity()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/productionCapacities',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"productionCapacities":[{"amount":1,"productionUnit":{"id":3,"name":"portion"},"timeUnit":{"id":1,"name":"daily"},"productGroup":{"id":56,"name":"bread"}},{"amount":5,"productionUnit":{"id":5,"name":"piece"},"timeUnit":{"id":2,"name":"weekly"},"productGroup":{"id":67,"name":"hot-dog"}}]}'
        );

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('SUCCESS', $content['result']);

        $client->request(
            'POST',
            '/api/productionCapacities',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"productionCapacities":[{"amount":"qwe","productionUnit":{"id":3,"name":"portion"},"timeUnit":{"id":1,"name":"daily"},"productGroup":{"id":56,"name":"bread"}},{"amount":5,"productionUnit":{"id":5,"name":"piece"},"timeUnit":{"id":2,"name":"weekly"},"productGroup":{"id":67,"name":"hot-dog"}}]}'
        );

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('ERROR', $content['result']);
        $this->assertEquals('AMOUNT_INVALID', $content['details'][0]['code']);

        $client->request(
            'POST',
            '/api/productionCapacities',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"productionCapacities":[{"amount":1,"productionUnit":{"id":3,"name":"pordtion"},"timeUnit":{"id":1,"name":"daily"},"productGroup":{"id":56,"name":"bread"}},{"amount":5,"productionUnit":{"id":5,"name":"piece"},"timeUnit":{"id":2,"name":"weekly"},"productGroup":{"id":67,"name":"hot-dog"}}]}'
        );

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('ERROR', $content['result']);
        $this->assertEquals('PRODUCTION_UNIT_NOT_FOUND', $content['details'][0]['code']);


        $client->request(
            'POST',
            '/api/productionCapacities',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"productionCapacities":[{"amount":1,"productionUnit":{"id":3,"name":"portion"},"timeUnit":{"id":1,"name":"dailydd"},"productGroup":{"id":56,"name":"bread"}},{"amount":5,"productionUnit":{"id":5,"name":"piece"},"timeUnit":{"id":2,"name":"weekly"},"productGroup":{"id":67,"name":"hot-dog"}}]}'
        );

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('ERROR', $content['result']);
        $this->assertEquals('TIME_UNIT_NOT_FOUND', $content['details'][0]['code']);
    }
}
