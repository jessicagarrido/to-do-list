<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class UserControllerTest extends WebTestCase
{
    private $client;
    private $container;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->container = static::getContainer();
    }

    public function testListUserAdmin(): void
    {
        $userRepository = $this->container->get(UserRepository::class);

        $adminUser = $userRepository->findOneBy(['username' => 'username_1']);
        $this->assertNotNull($adminUser, 'L\'utilisateur "username_1" est introuvable.');

        $this->client->loginUser($adminUser);
        $this->client->request('GET', '/users');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Liste des utilisateurs');
    }

    public function testUserListRedirectsIfNotAuthenticated(): void
    {
        $this->client->request('GET', '/users');

        $this->assertResponseRedirects('/login');
    }

    public function testCreateUserFormIsAccessible(): void
    {
        $userRepository = $this->container->get(UserRepository::class);

        $adminUser = $userRepository->findOneBy(['username' => 'username_1']);
        $this->assertNotNull($adminUser, 'L\'utilisateur "username_1" est introuvable.');

        $this->client->loginUser($adminUser);
        $this->client->request('GET', '/users/create');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'Ajouter');

    }

    public function testCreateUserWithValidData(): void
    {
    $userRepository = $this->container->get(UserRepository::class);

    $adminUser = $userRepository->findOneBy(['username' => 'username_1']);
    $this->assertNotNull($adminUser, 'L\'utilisateur "username_1" est introuvable.');

    $this->client->loginUser($adminUser);

    $crawler = $this->client->request('GET', '/users/create');

    $form = $crawler->selectButton('Ajouter')->form([
        'user[username]' => 'username_'.uniqid(),
        'user[password][first]' => 'todo2025',
        'user[password][second]' => 'todo2025',
        'user[mail]' => 'new_user@example.com',
        'user[roles][0]' => 'ROLE_USER', 

    ]);

    $this->client->submit($form);
    $session = $this->client->getRequest()->getSession();
    $flashes = $session->getFlashBag()->all();

    $this->assertArrayHasKey('success', $flashes);
    $this->assertCount(1, $flashes['success']);
    $this->assertEquals("L'utilisateur a bien été ajouté.", current($flashes['success']));
    $this->assertResponseRedirects('/users');

    $this->client->followRedirect();

    $this->assertResponseIsSuccessful();

    $this->assertSelectorTextContains('h1', 'Liste des utilisateurs');

    }

    public function testEditUserPageAccessible(): void
    {
        $userRepository = $this->container->get(UserRepository::class);

        $adminUser = $userRepository->findOneBy(['username' => 'username_1']);
        $this->assertNotNull($adminUser, 'L\'utilisateur "username_1" est introuvable.');

        $this->client->loginUser($adminUser);
        $this->client->request('GET', '/users/11/edit');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'Modifier');

    }

    public function testEditUser(): void
    {
        $userRepository = $this->container->get(UserRepository::class);

        $adminUser = $userRepository->findOneBy(['username' => 'username_1']);
        $this->assertNotNull($adminUser, 'L\'utilisateur "username_1" est introuvable.');
        
        $this->client->loginUser($adminUser);
        $crawler = $this->client->request('GET', '/users/11/edit');

        $form = $crawler->selectButton('Modifier')->form([
         'user[username]' => 'username_'.uniqid(),
         'user[password][first]' => 'todo2025',
         'user[password][second]' => 'todo2025',
         'user[mail]' => 'new_user@example.com',
         'user[roles][1]' => 'ROLE_ADMIN', 

     ]);

     $this->client->submit($form);

     $this->assertResponseRedirects('/users');

     $this->client->followRedirect();

     $this->assertResponseIsSuccessful();
     $this->assertSelectorTextContains('h1', 'Liste des utilisateurs');}
}
