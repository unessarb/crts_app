<?php

namespace App\Entity;

use App\Repository\BonCommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=BonCommandeRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class BonCommande
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
    private $numBc;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     */
    private $typeBc;

    /**
     * @ORM\ManyToOne(targetEntity=SocieteTitulaire::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $titulaire;

    /**
     * @ORM\ManyToOne(targetEntity=Societe::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $societe;

    /**
     * @ORM\ManyToOne(targetEntity=NatureOperationBonCommande::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $natureOperation;

    /**
     * @ORM\Column(type="string", length=1)
     * @Assert\NotBlank()
     */
    private $fontionnementInvestissement;

    /**
     * @ORM\Column(type="string", length=6)
     * @Assert\NotBlank()
     */
    private $anneeBudgetaire;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity=Tfs::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $tfs;

    /**
     * @ORM\ManyToOne(targetEntity=Devise::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $devise;

    /**
     * @ORM\ManyToOne(targetEntity=LigneBudgetaire::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $lineBudgetaire;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $documentPassation;

    /**
     * @Vich\UploadableField(mapping="bon_commande_files", fileNameProperty="documentPassation")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $documentPassationFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $documentExecution;

    /**
     * @Vich\UploadableField(mapping="bon_commande_files", fileNameProperty="documentExecution")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $documentExecutionFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeDoc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeBarImg;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumBc(): ?string
    {
        return $this->numBc;
    }

    public function setNumBc(string $numBc): self
    {
        $this->numBc = $numBc;

        return $this;
    }

    public function getTypeBc(): ?int
    {
        return $this->typeBc;
    }

    public function setTypeBc(int $typeBc): self
    {
        $this->typeBc = $typeBc;

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

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getNatureOperation(): ?NatureOperationBonCommande
    {
        return $this->natureOperation;
    }

    public function setNatureOperation(?NatureOperationBonCommande $natureOperation): self
    {
        $this->natureOperation = $natureOperation;

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

    public function getAnneeBudgetaire(): ?string
    {
        return $this->anneeBudgetaire;
    }

    public function setAnneeBudgetaire(string $anneeBudgetaire): self
    {
        $this->anneeBudgetaire = $anneeBudgetaire;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

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

    public function getDevise(): ?Devise
    {
        return $this->devise;
    }

    public function setDevise(?Devise $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getLineBudgetaire(): ?LigneBudgetaire
    {
        return $this->lineBudgetaire;
    }

    public function setLineBudgetaire(?LigneBudgetaire $lineBudgetaire): self
    {
        $this->lineBudgetaire = $lineBudgetaire;

        return $this;
    }

    public function setDocumentPassationFile(File $file = null)
    {
        $this->documentPassationFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getDocumentPassationFile()
    {
        return $this->documentPassationFile;
    }

    public function setDocumentPassation($documentPassation)
    {
        $this->documentPassation = $documentPassation;
    }

    public function getDocumentPassation()
    {
        return $this->documentPassation;
    }

    public function setDocumentExecutionFile(File $file = null)
    {
        $this->documentExecutionFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getDocumentExecutionFile()
    {
        return $this->documentExecutionFile;
    }

    public function setDocumentExecution($documentExecution)
    {
        $this->documentExecution = $documentExecution;
    }

    public function getDocumentExecution()
    {
        return $this->documentExecution;
    }

    public function getCodeDoc(): ?string
    {
        return $this->codeDoc;
    }

    public function setCodeDoc(string $codedoc): self
    {
        $this->codeDoc = $codedoc;

        return $this;
    }

    public function getCodeBarImg(): ?string
    {
        return $this->codeBarImg;
    }

    public function setCodeBarImg(string $codeBarImg): self
    {
        $this->codeBarImg = $codeBarImg;

        return $this;
    }
}