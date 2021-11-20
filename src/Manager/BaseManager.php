<?php

namespace App\Manager;

class BaseManager
{
    public function __construct(
        protected $em,
        protected $serializer,
        ) {}

    public function persistFlush(object $object): object
    {
        $this->em->persist($object);
        $this->em->flush($object);
        return $object;
    }
}