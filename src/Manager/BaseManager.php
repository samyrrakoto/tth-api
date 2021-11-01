<?php

namespace App\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class BaseManager
{
    protected $em;
    protected $serializer;

    public function __construct($em, $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function persistFlush(object $object): object
    {
        $this->em->persist($object);
        $this->em->flush($object);
        return $object;
    }
}