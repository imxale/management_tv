<?php

namespace App\Entity;

use App\Repository\EmissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmissionRepository::class)
 */
class Emission
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titreoriginal;

    /**
     * @ORM\Column(type="date")
     */
    private $anneproduction;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numsaison;

    /**
     * @ORM\OneToMany(targetEntity=Programme::class, mappedBy="id_emission")
     */
    private $programmes;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="emissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTitreoriginal(): ?string
    {
        return $this->titreoriginal;
    }

    public function setTitreoriginal(?string $titreoriginal): self
    {
        $this->titreoriginal = $titreoriginal;

        return $this;
    }

    public function getAnneproduction(): ?\DateTimeInterface
    {
        return $this->anneproduction;
    }

    public function setAnneproduction(\DateTimeInterface $anneproduction): self
    {
        $this->anneproduction = $anneproduction;

        return $this;
    }

    public function getNumsaison(): ?int
    {
        return $this->numsaison;
    }

    public function setNumsaison(?int $numsaison): self
    {
        $this->numsaison = $numsaison;

        return $this;
    }

    /**
     * @return Collection<int, Programme>
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes[] = $programme;
            $programme->setIdEmission($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getIdEmission() === $this) {
                $programme->setIdEmission(null);
            }
        }

        return $this;
    }

    public function getIdGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setIdGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
