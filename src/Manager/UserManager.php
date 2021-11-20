<?php

namespace App\Manager;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager extends BaseManager
{
    public function __construct(
        $em,
        $serializer,
        private UserPasswordHasherInterface $pwdHasher,
        )
    {
        parent::__construct($em, $serializer);
    }

    public function createUser(string $payload): User
    {
        $user = new User();
        $user = $this->serializer->deserialize($payload, User::class, 'json');
        $user->setPassword($this->pwdHasher->hashPassword($user, $user->getPassword()));

        return $this->persistFlush($user);
    }
}