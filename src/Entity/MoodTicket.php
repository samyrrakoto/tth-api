<?php

namespace App\Entity;

use App\Repository\MoodTicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MoodTicketRepository::class)
 */
class MoodTicket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $thought;

    /**
     * @ORM\Column(type="smallint")
     */
    private $mood;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThought(): ?string
    {
        return $this->thought;
    }

    public function setThought(string $thought): self
    {
        $this->thought = $thought;

        return $this;
    }

    public function getMood(): ?int
    {
        return $this->mood;
    }

    public function setMood(int $mood): self
    {
        $this->mood = $mood;

        return $this;
    }
}
