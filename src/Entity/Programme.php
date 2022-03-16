<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgrammeRepository::class)
 */
class Programme
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
     * @ORM\Column(type="bigint")
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity=Diffusion::class, mappedBy="id_programme")
     */
    private $diffusions;

    /**
     * @ORM\ManyToOne(targetEntity=Emission::class, inversedBy="programmes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_emission;

    /**
     * @ORM\ManyToOne(targetEntity=Categoriecsa::class, inversedBy="programmes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_categoriecsa;

    public function __construct()
    {
        $this->diffusions = new ArrayCollection();
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

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection<int, Diffusion>
     */
    public function getDiffusions(): Collection
    {
        return $this->diffusions;
    }

    public function addDiffusion(Diffusion $diffusion): self
    {
        if (!$this->diffusions->contains($diffusion)) {
            $this->diffusions[] = $diffusion;
            $diffusion->setIdProgramme($this);
        }

        return $this;
    }

    public function removeDiffusion(Diffusion $diffusion): self
    {
        if ($this->diffusions->removeElement($diffusion)) {
            // set the owning side to null (unless already changed)
            if ($diffusion->getIdProgramme() === $this) {
                $diffusion->setIdProgramme(null);
            }
        }

        return $this;
    }

    public function getIdEmission(): ?Emission
    {
        return $this->id_emission;
    }

    public function setIdEmission(?Emission $id_emission): self
    {
        $this->id_emission = $id_emission;

        return $this;
    }

    public function getIdCategoriecsa(): ?Categoriecsa
    {
        return $this->id_categoriecsa;
    }

    public function setIdCategoriecsa(?Categoriecsa $id_categoriecsa): self
    {
        $this->id_categoriecsa = $id_categoriecsa;

        return $this;
    }
}
