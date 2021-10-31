<?php

namespace App\Entity;

use App\Repository\NatureOperationBonCommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NatureOperationBonCommandeRepository::class)
 */
class NatureOperationBonCommande
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

    /**
     * @ORM\ManyToOne(targetEntity=Tfs::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $tfs;

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

    public function getTfs(): ?Tfs
    {
        return $this->tfs;
    }

    public function setTfs(?Tfs $tfs): self
    {
        $this->tfs = $tfs;

        return $this;
    }
}