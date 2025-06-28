<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testTitleGetterAndSetter(): void
    {
        $task = new Task();
        $task->setTitle('Test Title');
        $this->assertSame('Test Title', $task->getTitle());
    }

    public function testContentGetterAndSetter(): void
    {
        $task = new Task();
        $task->setContent('Some content here');
        $this->assertSame('Some content here', $task->getContent());
    }

    public function testCreatedAtDefaultValue(): void
    {
        $task = new Task();
        $this->assertInstanceOf(\DateTimeInterface::class, $task->getCreatedAt());
    }

    public function testCreatedAtSetter(): void
    {
        $task = new Task();
        $date = new \DateTimeImmutable('2023-01-01');
        $task->setCreatedAt($date);
        $this->assertSame($date, $task->getCreatedAt());
    }

    public function testIsDoneDefaultValue(): void
    {
        $task = new Task();
        $this->assertFalse($task->isDone());
    }

    public function testSetIsDone(): void
    {
        $task = new Task();
        $task->setIsDone(true);
        $this->assertTrue($task->isDone());
    }

    public function testToggle(): void
    {
        $task = new Task();
        $task->toggle(true);
        $this->assertTrue($task->isDone());

        $task->toggle(false);
        $this->assertFalse($task->isDone());
    }

    public function testUserSetterAndGetter(): void
    {
        $task = new Task();
        $user = $this->createMock(User::class);
        $task->setUser($user);
        $this->assertSame($user, $task->getUser());
    }
}
