<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=SocieteRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Societe
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable= true)
     * @Assert\NotBlank()
     */
    private $code_societe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=SocieteTitulaire::class, inversedBy="societes")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $titulaire;

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

    public function getCodeSociete(): ?int
    {
        return $this->code_societe;
    }

    public function setCodeSociete(int $code_societe): self
    {
        $this->code_societe = $code_societe;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTitulaire(): ?SocieteTitulaire
    {
        return $this->titulaire;
    }

    public function setTitulaire(?SocieteTitulaire $titulaire): self
    {
        $this->titulaire = $titulaire;

        return $this;
    }
}