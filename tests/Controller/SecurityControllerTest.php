<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    // Test d’affichage du formulaire de login (GET /login)
    public function testLoginPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
        $this->assertSelectorExists('input[name="_username"]');
        $this->assertSelectorExists('input[name="_password"]');
    }

    // Test de tentative de connexion échouée
    public function testLoginWithInvalidCredentialsShowsError(): void
    {
        $client = static::createClient();

        $client->request('POST', '/login', [
            '_username' => 'invalid_user',
            '_password' => 'invalid_pass',
        ]);

        $this->assertResponseRedirects('/login');

        $client->followRedirect();
        $this->assertSelectorExists('.alert');
    }

    // Test de redirection après login réussi
    public function testLoginWithValidCredentials(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form([
            '_username' => 'username_1',
            '_password' => 'todo2025',
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/');
    }

    // Ancien test de logout remplacé par version améliorée
    public function testLogoutRedirectsToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/logout');

        $this->assertTrue($client->getResponse()->isRedirection());

        $crawler = $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html', "Nom d'utilisateur :");
        $this->assertSelectorTextContains('html', 'Mot de passe :');
    }
}
