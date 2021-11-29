<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Contrat
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
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     */
    private $typeContrat;

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
     * @ORM\ManyToOne(targetEntity=NatureOperationContrat::class)
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
     * @Vich\UploadableField(mapping="contrat_files", fileNameProperty="documentPassation")
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
     * @Vich\UploadableField(mapping="contrat_files", fileNameProperty="documentExecution")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $documentExecutionFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $demandeDevis;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="demandeDevis")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $demandeDevisFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $lettreSntl;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="lettreSntl")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $lettreSntlFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $contratSigne;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="contratSigne")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $contratSigneFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $conventionSigne;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="conventionSigne")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $conventionSigneFile;

     /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $devisContradictoire;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="devisContradictoire")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $devisContradictoireFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $contratSignePaiement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="contratSignePaiement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $contratSignePaiementFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $bonLivraison;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="bonLivraison")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $bonLivraisonFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $facture;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="facture")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $factureFile;


    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $bordereau;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="bordereau")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $bordereauFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $ordonnancement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="ordonnancement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $ordonnancementFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $avisVirement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="avisVirement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $avisVirementFile;

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

    public function getNumCC(): ?string
    {
        return $this->numCC;
    }

    public function setNumCC(string $numCC): self
    {
        $this->numCC = $numCC;

        return $this;
    }

    public function getTypeContrat(): ?int
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(int $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

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

    public function getNatureOperation(): ?NatureOperationContrat
    {
        return $this->natureOperation;
    }

    public function setNatureOperation(?NatureOperationContrat $natureOperation): self
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

    public function setDemandeDevisFile(File $file = null)
    {
        $this->demandeDevisFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getDemandeDevisFile()
    {
        return $this->demandeDevisFile;
    }

    public function setDemandeDevis($demandeDevis)
    {
        $this->demandeDevis = $demandeDevis;
    }

    public function getDemandeDevis()
    {
        return $this->demandeDevis;
    }

    public function setLettreSntlFile(File $file = null)
    {
        $this->lettreSntlFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getLettreSntlFile()
    {
        return $this->lettreSntlFile;
    }

    public function setLettreSntl($lettreSntl)
    {
        $this->lettreSntl = $lettreSntl;
    }

    public function getLettreSntl()
    {
        return $this->lettreSntl;
    }

    public function setContratSigneFile(File $file = null)
    {
        $this->contratSigneFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getContratSigneFile()
    {
        return $this->contratSigneFile;
    }

    public function setContratSigne($contratSigne)
    {
        $this->contratSigne = $contratSigne;
    }

    public function getContratSigne()
    {
        return $this->contratSigne;
    }

    public function setConventionSigneFile(File $file = null)
    {
        $this->contratSigneFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getConventionSigneFile()
    {
        return $this->conventionSigneFile;
    }

    public function setConventionSigne($conventionSigne)
    {
        $this->conventionSigne = $conventionSigne;
    }

    public function getConventionSigne()
    {
        return $this->conventionSigne;
    }

    public function setDevisContradictoireFile(File $file = null)
    {
        $this->devisContradictoireFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getDevisContradictoireFile()
    {
        return $this->devisContradictoireFile;
    }

    public function setDevisContradictoire($devisContradictoire)
    {
        $this->devisContradictoire = $devisContradictoire;
    }

    public function getDevisContradictoire()
    {
        return $this->devisContradictoire;
    }

    public function setContratSignePaiementFile(File $file = null)
    {
        $this->contratSignePaiementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getContratSignePaiementFile()
    {
        return $this->contratSignePaiementFile;
    }

    public function setContratSignePaiement($contratSignePaiement)
    {
        $this->contratSignePaiement = $contratSignePaiement;
    }

    public function getContratSignePaiement()
    {
        return $this->contratSignePaiement;
    }
    

    public function setBonLivraisonFile(File $file = null)
    {
        $this->bonLivraisonFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getBonLivraisonFile()
    {
        return $this->bonLivraisonFile;
    }

    public function setBonLivraison($bonLivraison)
    {
        $this->bonLivraison = $bonLivraison;
    }

    public function getBonLivraison()
    {
        return $this->bonLivraison;
    }

    public function setFactureFile(File $file = null)
    {
        $this->factureFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getFactureFile()
    {
        return $this->factureFile;
    }

    public function setFacture($facture)
    {
        $this->facture = $facture;
    }

    public function getFacture()
    {
        return $this->facture;
    }

    public function setBordereauFile(File $file = null)
    {
        $this->bordereauFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getBordereauFile()
    {
        return $this->bordereauFile;
    }

    public function setBordereau($bordereau)
    {
        $this->bordereau = $bordereau;
    }

    public function getBordereau()
    {
        return $this->bordereau;
    }

    public function setOrdonnancementFile(File $file = null)
    {
        $this->ordonnancementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getOrdonnancementFile()
    {
        return $this->ordonnancementFile;
    }

    public function setOrdonnancement($ordonnancement)
    {
        $this->ordonnancement = $ordonnancement;
    }

    public function getOrdonnancement()
    {
        return $this->ordonnancement;
    }

    public function setAvisVirementFile(File $file = null)
    {
        $this->avisVirementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getAvisVirementFile()
    {
        return $this->avisVirementFile;
    }

    public function setAvisVirement($avisVirement)
    {
        $this->avisVirement = $avisVirement;
    }

    public function getAvisVirement()
    {
        return $this->avisVirement;
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