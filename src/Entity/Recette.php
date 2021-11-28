<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

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
     * @ORM\Column(type="float")
     */
    private $montant;

     /**
     * @ORM\ManyToOne(targetEntity=Devise::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $devise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $observations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $natureOperation;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @var string
     */
    private $justifcatif;

    /**
     * @Vich\UploadableField(mapping="justificatif", fileNameProperty="justifcatif")
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Veuillez télécharger un PDF valide"
     * )
     * @var File
     */
    private $justifcatifFile;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    public function getNatureOperation(): ?string
    {
        return $this->natureOperation;
    }

    public function setNatureOperation(?string $natureOperation): self
    {
        $this->natureOperation = $natureOperation;

        return $this;
    }

    public function setJustifcatifFile(File $file = null)
    {
        $this->justifcatifFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
    }

    public function getJustifcatifFile()
    {
        return $this->justifcatifFile;
    }

    public function setJustifcatif($justifcatif)
    {
        $this->justifcatif = $justifcatif;
    }

    public function getJustifcatif()
    {
        return $this->justifcatif;
    }

}