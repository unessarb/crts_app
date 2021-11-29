<?php

namespace App\Entity;

use App\Repository\PersonnelRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=PersonnelRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Personnel
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
     * @ORM\Column(type="string", length=255, nullable= true)
     * @Assert\NotBlank()
     */
    private $code_Personnel;

    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     * @Assert\NotBlank()
     */
    private $adresse;



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

    public function getCodePersonnel(): ?int
    {
        return $this->code_Personnel;
    }

    public function setCodePersonnel(int $code_Personnel): self
    {
        $this->code_Personnel = $code_Personnel;

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

}