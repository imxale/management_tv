<?php

namespace App\Entity;

use App\Repository\DiffusionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiffusionRepository::class)
 */
class Diffusion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $lejour;

    /**
     * @ORM\Column(type="time")
     */
    private $horaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $direct;

    /**
     * @ORM\ManyToOne(targetEntity=Programme::class, inversedBy="diffusions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_programme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLejour(): ?\DateTimeInterface
    {
        return $this->lejour;
    }

    public function setLejour(\DateTimeInterface $lejour): self
    {
        $this->lejour = $lejour;

        return $this;
    }

    public function getHoraire(): ?\DateTimeInterface
    {
        return $this->horaire;
    }

    public function setHoraire(\DateTimeInterface $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getDirect(): ?bool
    {
        return $this->direct;
    }

    public function setDirect(bool $direct): self
    {
        $this->direct = $direct;

        return $this;
    }

    public function getIdProgramme(): ?Programme
    {
        return $this->id_programme;
    }

    public function setIdProgramme(?Programme $id_programme): self
    {
        $this->id_programme = $id_programme;

        return $this;
    }
}
