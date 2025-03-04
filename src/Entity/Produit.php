<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

#[Vich\Uploadable]

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['produit:read']],
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['categorie' => 'exact'])]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['produit:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Assert\NotBlank(message: 'Le libellé est obligatoire')]
    #[Assert\Length(
        min: 3,
        max: 40,
        minMessage: 'Le libellé doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le libellé ne peut pas dépasser {{ limit }} caractères',
    )]
    #[Groups(['produit:read'])]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    #[Assert\NotBlank(message: 'Le prix est obligatoire')]
    #[Assert\Range(min: 0.1, max: 999)]
    #[Groups(['produit:read'])]
    private ?string $prix = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\Type("\DateTime")]
    #[Groups(['produit:read'])]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'La description est obligatoire')]
    #[Assert\Length(
        min: 15,
        max: 255,
        minMessage: 'La description doit comporter au moins {{ limit }} caractères',
        maxMessage: 'La description ne peut pas dépasser {{ limit }} caractères',
    )]
    #[Groups(['produit:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['produit:read'])]
    private ?bool $cru = null;

    #[ORM\Column]
    #[Groups(['produit:read'])]
    private ?bool $cuit = null;

    #[ORM\Column]
    #[Groups(['produit:read'])]
    private ?bool $bio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\Type("\DateTime")]
    #[Groups(['produit:read'])]
    private ?\DateTimeInterface $debutDisponibilite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Assert\Type("\DateTime")]
    #[Assert\Range(minPropertyPath: "debutDisponibilite")]
    #[Groups(['produit:read'])]
    private ?\DateTimeInterface $finDisponibilite = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['produit:read'])]
    private ?Categorie $categorie = null;

    #[ApiProperty(types: ['https://schema.org/imageUrl'])]
    #[Groups(['produit:read'])]
    public ?string $imageUrl = null;
    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'produits', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isCru(): ?bool
    {
        return $this->cru;
    }

    public function setCru(bool $cru): static
    {
        $this->cru = $cru;

        return $this;
    }

    public function isCuit(): ?bool
    {
        return $this->cuit;
    }

    public function setCuit(bool $cuit): static
    {
        $this->cuit = $cuit;

        return $this;
    }

    public function isBio(): ?bool
    {
        return $this->bio;
    }

    public function setBio(bool $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getDebutDisponibilite(): ?\DateTimeInterface
    {
        return $this->debutDisponibilite;
    }

    public function setDebutDisponibilite(?\DateTimeInterface $debutDisponibilite): static
    {
        $this->debutDisponibilite = $debutDisponibilite;

        return $this;
    }

    public function getFinDisponibilite(): ?\DateTimeInterface
    {
        return $this->finDisponibilite;
    }

    public function setFinDisponibilite(?\DateTimeInterface $finDisponibilite): static
    {
        $this->finDisponibilite = $finDisponibilite;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return '/images/produits/' . $this->imageName; // pour simplifier (sinon: var env et service)
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }
    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }
    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
}
