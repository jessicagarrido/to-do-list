<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\SecurityController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SecurityControllerTest extends WebTestCase
{
    // /**
    //  * Test the login route for the login page
    //  *
    //  * @return void
    //  */
    // public function testLoginRoute()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/login');
        
    //     $this->assertEquals(200, $client->getResponse()->getStatusCode());
    //     $this->assertSame(1, $crawler->filter('html:contains("Nom d\'utilisateur :")')->count());
    //     $this->assertSame(1, $crawler->filter('html:contains("Mot de passe :")')->count());
    // }
}