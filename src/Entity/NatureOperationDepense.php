<?php

namespace App\Entity;

use App\Repository\NatureOperationDepenseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NatureOperationDepenseRepository::class)
 */
class NatureOperationDepense
{
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $natureOperation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNatureOperation(): ?string
    {
        return $this->natureOperation;
    }

    public function setNatureOperation(string $natureOperation): self
    {
        $this->natureOperation = $natureOperation;

        return $this;
    }
}