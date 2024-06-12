<?php

namespace App\Entity;

use App\Repository\PassageEmployeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassageEmployeRepository::class)]
class PassageEmploye
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Race = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Nourriture = null;

    #[ORM\Column(length: 255)]
    private ?string $Quantite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $Heure = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->Heure;
    }

    public function setHeure(\DateTimeInterface $Heure): static
    {
        $this->Heure = $Heure;

        return $this;
    }
}
