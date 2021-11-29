<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\MarcheUniqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=MarcheUniqueRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class MarcheUnique
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
    private $numMarche;


    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     */
    private $typeMarche;

    /**
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     */
    private $modePassassion;

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
     * @ORM\ManyToOne(targetEntity=NatureOperationMarcheUnique::class)
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
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="documentPassation")
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
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="documentExecution")
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
    private $lettreDeLancement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="lettreDeLancement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $lettreDeLancementFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $decision;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="decision")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $decisionFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $avisJournaux;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="avisJournaux")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $avisJournauxFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $convocationTM;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="convocationTM")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $convocationTMFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $pvTechnique;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="pvTechnique")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $pvTechniqueFile;

     /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $lettreJustification;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="lettreJustification")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $lettreJustificationFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $lettreComplement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="lettreComplement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $lettreComplementFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $marcheSigne;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="marcheSigne")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $marcheSigneFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $certificatAdministratif;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="certificatAdministratif")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $certificatAdministratifFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $avisJournauxEngagement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="avisJournauxEngagement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $avisJournauxEngagementFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $caution;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="caution")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $cautionFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $pouvoir;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="pouvoir")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $pouvoirFile;

     /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $retenue;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="retenue")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $retenueFile;

     /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $ficheModele;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="ficheModele")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $ficheModeleFile;

     /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $etatEngagement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="etatEngagement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $etatEngagementFile;

     /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $marcheSignePaiement;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="marcheSignePaiement")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $marcheSignePaiementFile;

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
    private $ficheIntervention;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="ficheIntervention")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $ficheInterventionFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $decomptes;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="decomptes")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $decomptesFile;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $procesVerbal;

    /**
     * @Vich\UploadableField(mapping="marche_unique_files", fileNameProperty="procesVerbal")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $procesVerbalFile;

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

    public function getNumMarche(): ?string
    {
        return $this->numMarche;
    }

    public function setNumMarche(string $numMarche): self
    {
        $this->numMarche = $numMarche;

        return $this;
    }

    public function getTypeMarche(): ?int
    {
        return $this->typeMarche;
    }

    public function setTypeMarche(int $typeMarche): self
    {
        $this->typeMarche = $typeMarche;

        return $this;
    }

    public function getModePassassion(): ?int
    {
        return $this->modePassassion;
    }

    public function setModePassassion(int $modePassassion): self
    {
        $this->modePassassion = $modePassassion;

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

    public function getNatureOperation(): ?NatureOperationMarcheUnique
    {
        return $this->natureOperation;
    }

    public function setNatureOperation(?NatureOperationMarcheUnique $natureOperation): self
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

    public function setLettreDeLancementFile(File $file = null)
    {
        $this->lettreDeLancementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getLettreDeLancementFile()
    {
        return $this->lettreDeLancementFile;
    }

    public function setLettreDeLancement($lettreDeLancement)
    {
        $this->lettreDeLancement = $lettreDeLancement;
    }

    public function getLettreDeLancement()
    {
        return $this->lettreDeLancement;
    }

    public function setDecisionFile(File $file = null)
    {
        $this->decisionFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getDecisionFile()
    {
        return $this->decisionFile;
    }

    public function setDecision($decision)
    {
        $this->decision = $decision;
    }

    public function getDecision()
    {
        return $this->decision;
    }

    public function setAvisJournauxFile(File $file = null)
    {
        $this->avisJournauxFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getAvisJournauxFile()
    {
        return $this->avisJournauxFile;
    }

    public function setAvisJournaux($avisJournaux)
    {
        $this->avisJournaux = $avisJournaux;
    }

    public function getAvisJournaux()
    {
        return $this->avisJournaux;
    }

    public function setConvocationTMFile(File $file = null)
    {
        $this->convocationTMFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getConvocationTMFile()
    {
        return $this->convocationTMFile;
    }

    public function setConvocationTM($convocationTM)
    {
        $this->convocationTM = $convocationTM;
    }

    public function getConvocationTM()
    {
        return $this->convocationTM;
    }

    public function setPvTechniqueFile(File $file = null)
    {
        $this->pvTechniqueFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getPvTechniqueFile()
    {
        return $this->pvTechniqueFile;
    }

    public function setPvTechnique($pvTechnique)
    {
        $this->pvTechnique = $pvTechnique;
    }

    public function getPvTechnique()
    {
        return $this->pvTechnique;
    }

    public function setLettreJustificationFile(File $file = null)
    {
        $this->lettreJustificationFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getLettreJustificationFile()
    {
        return $this->lettreJustificationFile;
    }

    public function setLettreJustification($lettreJustification)
    {
        $this->lettreJustification = $lettreJustification;
    }

    public function getLettreJustification()
    {
        return $this->lettreJustification;
    }

    public function setLettreComplementFile(File $file = null)
    {
        $this->lettreComplementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getLettreComplementFile()
    {
        return $this->lettreComplementFile;
    }

    public function setLettreComplement($lettreComplement)
    {
        $this->lettreComplement = $lettreComplement;
    }

    public function getLettreComplement()
    {
        return $this->lettreComplement;
    }

    public function setMarcheSigneFile(File $file = null)
    {
        $this->marcheSigneFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getMarcheSigneFile()
    {
        return $this->marcheSigneFile;
    }

    public function setMarcheSigne($marcheSigne)
    {
        $this->marcheSigne = $marcheSigne;
    }

    public function getMarcheSigne()
    {
        return $this->marcheSigne;
    }

    public function setCertificatAdministratifFile(File $file = null)
    {
        $this->certificatAdministratifFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getCertificatAdministratifFile()
    {
        return $this->certificatAdministratifFile;
    }

    public function setCertificatAdministratif($certificatAdministratif)
    {
        $this->certificatAdministratif = $certificatAdministratif;
    }

    public function getCertificatAdministratif()
    {
        return $this->certificatAdministratif;
    }

    public function setAvisJournauxEngagementFile(File $file = null)
    {
        $this->avisJournauxEngagementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getAvisJournauxEngagementFile()
    {
        return $this->avisJournauxEngagementFile;
    }

    public function setAvisJournauxEngagement($avisJournauxEngagement)
    {
        $this->avisJournauxEngagement = $avisJournauxEngagement;
    }

    public function getAvisJournauxEngagement()
    {
        return $this->avisJournauxEngagement;
    }

    public function setCautionFile(File $file = null)
    {
        $this->cautionFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getCautionFile()
    {
        return $this->cautionFile;
    }

    public function setCaution($caution)
    {
        $this->caution = $caution;
    }

    public function getCaution()
    {
        return $this->caution;
    }

    public function setPouvoirFile(File $file = null)
    {
        $this->pouvoirFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getPouvoirFile()
    {
        return $this->pouvoirFile;
    }

    public function setPouvoir($pouvoir)
    {
        $this->pouvoir = $pouvoir;
    }

    public function getPouvoir()
    {
        return $this->pouvoir;
    }

    public function setRetenueFile(File $file = null)
    {
        $this->retenueFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getRetenueFile()
    {
        return $this->retenueFile;
    }

    public function setRetenue($retenue)
    {
        $this->retenue = $retenue;
    }

    public function getRetenue()
    {
        return $this->retenue;
    }

    public function setFicheModeleFile(File $file = null)
    {
        $this->ficheModeleFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getFicheModeleFile()
    {
        return $this->ficheModeleFile;
    }

    public function setFicheModele($ficheModele)
    {
        $this->ficheModele = $ficheModele;
    }

    public function getFicheModele()
    {
        return $this->ficheModele;
    }

    public function setEtatEngagementFile(File $file = null)
    {
        $this->etatEngagementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getEtatEngagementFile()
    {
        return $this->etatEngagementFile;
    }

    public function setEtatEngagement($etatEngagement)
    {
        $this->etatEngagement = $etatEngagement;
    }

    public function getEtatEngagement()
    {
        return $this->etatEngagement;
    }

    public function setMarcheSignePaiementFile(File $file = null)
    {
        $this->marcheSignePaiementFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getMarcheSignePaiementFile()
    {
        return $this->marcheSignePaiementFile;
    }

    public function setMarcheSignePaiement($marcheSignePaiement)
    {
        $this->marcheSignePaiement = $marcheSignePaiement;
    }

    public function getMarcheSignePaiement()
    {
        return $this->marcheSignePaiement;
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

    public function setFicheInterventionFile(File $file = null)
    {
        $this->ficheInterventionFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getFicheInterventionFile()
    {
        return $this->ficheInterventionFile;
    }

    public function setFicheIntervention($ficheIntervention)
    {
        $this->ficheIntervention = $ficheIntervention;
    }

    public function getFicheIntervention()
    {
        return $this->ficheIntervention;
    }

    public function setDecomptesFile(File $file = null)
    {
        $this->decomptesFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getDecomptesFile()
    {
        return $this->decomptesFile;
    }

    public function setDecomptes($decomptes)
    {
        $this->decomptes = $decomptes;
    }

    public function getDecomptes()
    {
        return $this->decomptes;
    }

    public function setProcesVerbalFile(File $file = null)
    {
        $this->procesVerbalFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getProcesVerbalFile()
    {
        return $this->procesVerbalFile;
    }

    public function setProcesVerbal($procesVerbal)
    {
        $this->procesVerbal = $procesVerbal;
    }

    public function getProcesVerbal()
    {
        return $this->procesVerbal;
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