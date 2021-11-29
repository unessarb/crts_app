<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\LigneBudgetaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=LigneBudgetaireRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class LigneBudgetaire
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $num;


   
    /**
     * @ORM\Column(type="string", length=1)
     * @Assert\NotBlank()
     */
    private $fontionnementInvestissement;


    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $rubrique;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(string $numMarche): self
    {
        $this->num = $numMarche;

        return $this;
    }

    public function getFontionnementInvestissement(): ?string
    {
        return $this->fontionnementInvestissement;
    }

    public function setFontionnementInvestissement(string $fontionnementInvestissement): self
    {
        $this->fontionnementInvestissement = $fontionnementInvestissement;

        return $this;
    }

    public function getRubrique(): ?string
    {
        return $this->rubrique;
    }

    public function setRubrique(string $codedoc): self
    {
        $this->rubrique = $codedoc;

        return $this;
    }

}