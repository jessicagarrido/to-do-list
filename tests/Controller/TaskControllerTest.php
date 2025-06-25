<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

final class TaskControllerTest extends WebTestCase
{
//     protected $databaseTool;
//     private $client;
//     private $user;
//     private $container;
//     private $taskRepository;

//    protected function setUp(): void
// {
//     parent::setUp();
//     $this->client = static::createClient();
//     $this->container = static::getContainer();

//     $this->databaseTool = $this->container->get(DatabaseToolCollection::class)->get();
//     $this->databaseTool->loadFixtures([AppFixtures::class]);



//     // Récupérer utilisateur et repository
//     $this->user = $this->container->get(UserRepository::class)->findOneBy(['username' => 'username_1']);
//     $this->assertNotNull($this->user);
//     $this->taskRepository = $this->container->get(TaskRepository::class);

//     $this->client->loginUser($this->user);
// }


//     public function testTaskListIsAccessible(): void
//     {
//         $this->client->request('GET', '/tasks');
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorExists('.glyphicon');
//     }

//     public function testCreateTaskFormIsAccessible(): void
//     {
//         $this->client->request('GET', '/tasks/create');
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorExists('form');
//     }

//     public function testSubmitNewTask(): void
//     {
//         $crawler = $this->client->request('GET', '/tasks/create');

//         $form = $crawler->selectButton('Ajouter')->form([
//             'task[title]' => 'Test Task',
//             'task[content]' => 'Description de test',
//         ]);

//         $this->client->submit($form);

//         $this->assertResponseRedirects('/tasks');
//         $this->client->followRedirect();
//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('html', 'Test Task');
//     }

//     public function testEditTask(): void
//     {
//         $task = $this->taskRepository->findOneBy(['user' => $this->user]);
//         $this->assertNotNull($task);

//         $crawler = $this->client->request('GET', '/tasks/' . $task->getId() . '/edit');

//         $form = $crawler->selectButton('Modifier')->form([
//             'task[title]' => 'Tâche modifiée',
//         ]);

//         $this->client->submit($form);

//         $this->assertResponseRedirects('/tasks');
//         $this->client->followRedirect();
//         $this->assertSelectorTextContains('html', 'Tâche modifiée');
//     }

//     public function testToggleTaskDone(): void
//     {
//         $task = $this->taskRepository->findOneBy(['user' => $this->user]);
//         $this->assertNotNull($task);

//         $this->client->request('GET', '/tasks/' . $task->getId() . '/toggle');
//         $this->client->followRedirect();

//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('html', 'La tâche a bien été marquée comme faite.');
//     }

//     public function testDeleteTask(): void
//     {
//         $task = $this->taskRepository->findOneBy(['user' => $this->user]);
//         $this->assertNotNull($task);

//         $this->client->request('GET', '/tasks/' . $task->getId() . '/delete');
//         $this->client->followRedirect();

//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('html', 'La tâche a bien été supprimée.');

//         $deletedTask = $this->taskRepository->find($task->getId());
//         $this->assertNull($deletedTask);
//     }
}
