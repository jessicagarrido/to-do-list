<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $users=[];
        for ($i = 1; $i < 10; ++$i) {
            $user = new User();
            $user->setUsername('username_'.$i)
                ->setPassword($this->passwordHasher->hashPassword($user, 'todo2025'));
                if($i == 1){
                    $user->setRoles(['ROLE_ADMIN']);
                } else {
                    $user->setRoles(['ROLE_USER']);
                }
                $user->setMail('username_'.$i.'@gmail.fr');
            $manager->persist($user);
            $users[]= $user;
        }

        for ($i = 1; $i < 30; ++$i) {
            $task = new Task();
            $task->setTitle('title_'.$i)
                ->setContent('content_'.$i)
                ->setCreatedAt(new \DateTime())
                ->setIsDone(rand(true, false));
                if ($i < 10) {
                    $task->setUser(null);
                } else {
                    $task->setUser($users[rand(0, count($users) - 1)]);
                }

            $manager->persist($task);
        }

        $manager->flush();
    }
}
