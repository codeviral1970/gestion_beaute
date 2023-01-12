<?php

namespace App\Tests\Func;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testHomeController(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Dashboard');
    }

    public function testClientsController(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/clients');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'listes des clients');
    }
    
}
