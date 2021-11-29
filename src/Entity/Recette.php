<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Recette
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
    private $numCC;





    /**
     * @ORM\ManyToOne(targetEntity=NatureRecette::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $natureRecette;

    /**
     * @ORM\Column(type="string", length=800)
     * @Assert\NotBlank()
     */
    private $partieversantes;


    /**
     * @ORM\Column(type="string", length=1000, nullable = true)
     */
    private $obs;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $montant;

   

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $documentPassation;

    /**
     * @Vich\UploadableField(mapping="recette_files", fileNameProperty="documentPassation")
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
     * @Vich\UploadableField(mapping="recette_files", fileNameProperty="documentExecution")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $documentExecutionFile;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCC(): ?string
    {
        return $this->numCC;
    }

    public function setNumCC(string $numCC): self
    {
        $this->numCC = $numCC;

        return $this;
    }





    public function getNatureRecette(): ?NatureRecette
    {
        return $this->natureRecette;
    }

    public function setNatureRecette(?NatureRecette $natureOperation): self
    {
        $this->natureRecette = $natureOperation;

        return $this;
    }

    public function getPartieversantes(): ?string
    {
        return $this->partieversantes;
    }

    public function setPartieversantes(string $fontionnementInvestissement): self
    {
        $this->partieversantes = $fontionnementInvestissement;

        return $this;
    }

    public function getObs(): ?string
    {
        return $this->obs;
    }

    public function setObs(string $fontionnementInvestissement): self
    {
        $this->obs = $fontionnementInvestissement;

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

    
}