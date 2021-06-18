<?php

namespace App\Entity;

use App\Repository\PatientProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientProfileRepository::class)
 */
class PatientProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=DoctorProfile::class, mappedBy="medicalRelation")
     */
    private $medicalRelation;

    public function __construct()
    {
        $this->medicalRelation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|DoctorProfile[]
     */
    public function getMedicalRelation(): Collection
    {
        return $this->medicalRelation;
    }

    public function addMedicalRelation(DoctorProfile $medicalRelation): self
    {
        if (!$this->medicalRelation->contains($medicalRelation)) {
            $this->medicalRelation[] = $medicalRelation;
            $medicalRelation->addMedicalRelation($this);
        }

        return $this;
    }

    public function removeMedicalRelation(DoctorProfile $medicalRelation): self
    {
        if ($this->medicalRelation->removeElement($medicalRelation)) {
            $medicalRelation->removeMedicalRelation($this);
        }

        return $this;
    }
}
