<?php

namespace App\Manager;

use App\Entity\User;
use App\Entity\UserProfile;

class UserProfileManager extends BaseManager
{
    public function __construct(
        $em,
        $serializer,
        )
    {
        parent::__construct($em, $serializer);
    }

    public function createUserProfile(User $user, string $payload): User
    {
        $profile = new UserProfile();
        $profile = $this->serializer->deserialize($payload, UserProfile::class, 'json');
        $user->setProfile($profile);

        return $this->persistFlush($user);
    }
}