<?php

namespace App\Entity;

use App\Repository\DoctorProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorProfileRepository::class)
 */
class DoctorProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=patientProfile::class, inversedBy="medicalRelation")
     * @ORM\JoinTable(name="patient_profile_join")
     */
    private $medicalRelation;

    /**
     * @ORM\ManyToMany(targetEntity=Cabinet::class, mappedBy="doctorProfile")
     */
    private $cabinet;

    /**
     * @ORM\ManyToMany(targetEntity=specialty::class, inversedBy="doctorProfile")
     * @ORM\JoinTable(name="specialty_join")
     */
    private $specialty;

    public function __construct()
    {
        $this->medicalRelation = new ArrayCollection();
        $this->cabinet = new ArrayCollection();
        $this->specialty = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|patientProfile[]
     */
    public function getMedicalRelation(): Collection
    {
        return $this->medicalRelation;
    }

    public function addMedicalRelation(patientProfile $medicalRelation): self
    {
        if (!$this->medicalRelation->contains($medicalRelation)) {
            $this->medicalRelation[] = $medicalRelation;
        }

        return $this;
    }

    public function removeMedicalRelation(patientProfile $medicalRelation): self
    {
        $this->medicalRelation->removeElement($medicalRelation);

        return $this;
    }

    /**
     * @return Collection|Cabinet[]
     */
    public function getCabinet(): Collection
    {
        return $this->cabinet;
    }

    public function addCabinet(Cabinet $cabinet): self
    {
        if (!$this->cabinet->contains($cabinet)) {
            $this->cabinet[] = $cabinet;
            $cabinet->addDoctorProfile($this);
        }

        return $this;
    }

    public function removeCabinet(Cabinet $cabinet): self
    {
        if ($this->cabinet->removeElement($cabinet)) {
            $cabinet->removeDoctorProfile($this);
        }

        return $this;
    }

    /**
     * @return Collection|specialty[]
     */
    public function getSpecialty(): Collection
    {
        return $this->specialty;
    }

    public function addSpecialty(specialty $specialty): self
    {
        if (!$this->specialty->contains($specialty)) {
            $this->specialty[] = $specialty;
        }

        return $this;
    }

    public function removeSpecialty(specialty $specialty): self
    {
        $this->specialty->removeElement($specialty);

        return $this;
    }
}
