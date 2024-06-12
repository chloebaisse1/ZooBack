<?php

namespace App\Entity;

use App\Repository\ComptesRendusVetoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComptesRendusVetoRepository::class)]
class ComptesRendusVeto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Race = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Etat = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Nourriture = null;

    #[ORM\Column(length: 255)]
    private ?string $Quantite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Passage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Detail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->Race;
    }

    public function setRace(string $Race): static
    {
        $this->Race = $Race;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): static
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getNourriture(): ?string
    {
        return $this->Nourriture;
    }

    public function setNourriture(string $Nourriture): static
    {
        $this->Nourriture = $Nourriture;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->Quantite;
    }

    public function setQuantite(string $Quantite): static
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getPassage(): ?\DateTimeInterface
    {
        return $this->Passage;
    }

    public function setPassage(\DateTimeInterface $Passage): static
    {
        $this->Passage = $Passage;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->Detail;
    }

    public function setDetail(?string $Detail): static
    {
        $this->Detail = $Detail;

        return $this;
    }
}
