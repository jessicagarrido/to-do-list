<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Task;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUsernameGetterAndSetter(): void
    {
        $user = new User();
        $user->setUsername('john_doe');
        $this->assertSame('john_doe', $user->getUsername());
    }

    public function testUserIdentifier(): void
    {
        $user = new User();
        $user->setUsername('john_doe');
        $this->assertSame('john_doe', $user->getUserIdentifier());
    }

    public function testPasswordGetterAndSetter(): void
    {
        $user = new User();
        $user->setPassword('hashed_password');
        $this->assertSame('hashed_password', $user->getPassword());
    }

    public function testMailGetterAndSetter(): void
    {
        $user = new User();
        $user->setMail('john@example.com');
        $this->assertSame('john@example.com', $user->getMail());
    }

    public function testRolesDefaultIncludesRoleUser(): void
    {
        $user = new User();
        $this->assertContains('ROLE_USER', $user->getRoles());
    }

    public function testSetAndGetRoles(): void
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $roles = $user->getRoles();

        $this->assertContains('ROLE_ADMIN', $roles);
        $this->assertContains('ROLE_USER', $roles); // Ajout automatique
        $this->assertCount(2, array_unique($roles));
    }

 public function testAddAndRemoveTask(): void
{
    $user = new User();

    $task = $this->getMockBuilder(Task::class)
        ->onlyMethods(['setUser', 'getUser'])
        ->disableOriginalConstructor()
        ->getMock();

    $task->expects($this->exactly(2))
        ->method('setUser')
        ->withConsecutive(
            [$this->equalTo($user)],   
            [$this->equalTo(null)]     
        );

    $task->method('getUser')->willReturn($user);

    $user->addTask($task);
    $this->assertTrue($user->getTasks()->contains($task));

    $user->removeTask($task);
    $this->assertFalse($user->getTasks()->contains($task));
}

    public function testEraseCredentials(): void
    {
        $user = new User();
        $this->assertNull($user->eraseCredentials()); 
        $this->assertTrue(method_exists($user, 'eraseCredentials'));
    }
}
