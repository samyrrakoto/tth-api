<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DayRepository;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DayRepository::class)
 * @Table(uniqueConstraints={@UniqueConstraint(name="user_day", columns={"date", "user_id"})})
 */
class Day
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["day"])]
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    #[Groups(["day"])]
    private $date;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    #[Groups(["day"])]
    private $rating;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    #[Groups(["day"])]
    private $mainEmotion;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="days")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getMainEmotion(): ?string
    {
        return $this->mainEmotion;
    }

    public function setMainEmotion(?string $mainEmotion): self
    {
        $this->mainEmotion = $mainEmotion;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
