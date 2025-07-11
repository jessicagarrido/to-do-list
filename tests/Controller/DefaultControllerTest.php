<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    //Test affichage de la page home si utilisateur connecté
    public function testHomePageIsAccessibleForAuthenticatedUser(): void
    {
        $client = static::createClient();

        $container = static::getContainer();

        $userRepository = $container->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['username' => 'username_1']);
        $this->assertNotNull($testUser, 'L\'utilisateur "username_1" est introuvable.');

        $client->loginUser($testUser);

        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains(
            'h1',
            "Bienvenue sur Todo List, l'application vous permettant de gérer l'ensemble de vos tâches sans effort !"
        );
    }

    // Test redirection vers la page login si l'utilisateur n'est pas connecté
    public function testHomePageRedirectsToLoginIfNotAuthenticated(): void
{
    $client = static::createClient();
    $client->request('GET', '/');
    $this->assertResponseRedirects('/login');
}


    // Test d'erreur 404
    public function testNonExistentPageReturns404(): void
{
    $client = static::createClient();
    $client->request('GET', '/page-inexistante');
    $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
}

}