<?php

namespace App\Entity;

use App\Repository\SpecialtyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialtyRepository::class)
 */
class Specialty
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=DoctorProfile::class, mappedBy="specialty")
     */
    private $doctorProfile;

    public function __construct()
    {
        $this->doctorProfile = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|DoctorProfile[]
     */
    public function getDoctorProfile(): Collection
    {
        return $this->doctorProfile;
    }

    public function addDoctorProfile(DoctorProfile $doctorProfile): self
    {
        if (!$this->doctorProfile->contains($doctorProfile)) {
            $this->doctorProfile[] = $doctorProfile;
            $doctorProfile->addSpecialty($this);
        }

        return $this;
    }

    public function removeDoctorProfile(DoctorProfile $doctorProfile): self
    {
        if ($this->doctorProfile->removeElement($doctorProfile)) {
            $doctorProfile->removeSpecialty($this);
        }

        return $this;
    }
}
