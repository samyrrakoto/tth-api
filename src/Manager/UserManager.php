<?php

namespace App\Manager;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager extends BaseManager
{
    private $pwdHasher;

    public function __construct($em, $serializer, UserPasswordHasherInterface  $pwdHasher)
    {
        parent::__construct($em, $serializer);
        $this->pwdHasher = $pwdHasher;
    }

    public function createUser(string $payload): User
    {
        $user = new User();
        $user = $this->serializer->deserialize($payload, User::class, 'json');
        $user->setPassword($this->pwdHasher->hashPassword($user, $user->getPassword()));

        return $this->persistFlush($user);
    }
}