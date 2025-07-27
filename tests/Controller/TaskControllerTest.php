<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

final class TaskControllerTest extends WebTestCase
{
    private $client;
    private $user;
    private $entityManager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();

        $userRepository = $container->get(UserRepository::class);
        $this->user = $userRepository->findOneBy([]); 

        $this->entityManager = $container->get(EntityManagerInterface::class);
    }

    private function loginUser(): void
    {
        $this->client->loginUser($this->user);
    }

    public function testTaskList(): void
    {
        $this->loginUser();
        $this->client->request('GET', '/tasks');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('a.btn.btn-info', 'Créer une tâche');

    }

public function testTaskListDone(): void
{
    $this->loginUser();
    $this->client->request('GET', '/tasks/done');
    $this->assertResponseIsSuccessful();

    $this->assertSelectorExists('.thumbnail');
    $this->assertSelectorTextContains('a.btn.btn-warning', 'Voir les tâches à faire');
}


    public function testCreateTask(): void
    {
        $this->loginUser();
        $crawler = $this->client->request('GET', '/tasks/create');

        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Ajouter')->form([
            'task[title]' => 'Tâche de test',
            'task[content]' => 'Contenu de test',
        ]);

        $this->client->submit($form);
        $this->client->followRedirect();

        $this->assertSelectorTextContains('.alert-success', 'La tâche a bien été ajoutée.');
    }

    public function testEditTask(): void
    {
        $this->loginUser();
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $task = $taskRepository->findOneBy(['user' => $this->user]);

        $crawler = $this->client->request('GET', '/tasks/' . $task->getId() . '/edit');

        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Modifier')->form([
            'task[title]' => 'Titre modifié',
            'task[content]' => 'Contenu modifié',
        ]);

        $this->client->submit($form);
        $this->client->followRedirect();

        $this->assertSelectorTextContains('.alert-success', 'La tâche a bien été modifiée.');
    }

    public function testToggleTask(): void
    {
        $this->loginUser();
        $taskRepository = static::getContainer()->get(TaskRepository::class);
        $task = $taskRepository->findOneBy(['user' => $this->user]);

        $this->client->request('GET', '/tasks/' . $task->getId() . '/toggle');
        $this->client->followRedirect();

        $this->assertSelectorTextContains('.alert-success', 'La tâche est bien terminée.');
    }

    public function testDeleteTask(): void
    {
        $this->loginUser();
        $task = new \App\Entity\Task();
        $task->setTitle('Tâche à supprimer');
        $task->setContent('Contenu');
        $task->setUser($this->user);
        $task->setIsDone(false);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        $id = $task->getId();

        $this->client->request('GET', '/tasks/' . $id . '/delete');
        $this->client->followRedirect();

        $this->assertSelectorTextContains('.alert-success', 'La tâche a bien été supprimée.');
    }
}
