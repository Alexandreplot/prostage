<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $string;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $courielContact;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="stages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="stages")
     */
    private $fromation;

    public function __construct()
    {
        $this->fromation = new ArrayCollection();
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

    public function getString(): ?string
    {
        return $this->string;
    }

    public function setString(string $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function getCourielContact(): ?string
    {
        return $this->courielContact;
    }

    public function setCourielContact(string $courielContact): self
    {
        $this->courielContact = $courielContact;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFromation(): Collection
    {
        return $this->fromation;
    }

    public function addFromation(Formation $fromation): self
    {
        if (!$this->fromation->contains($fromation)) {
            $this->fromation[] = $fromation;
        }

        return $this;
    }

    public function removeFromation(Formation $fromation): self
    {
        $this->fromation->removeElement($fromation);

        return $this;
    }
}
