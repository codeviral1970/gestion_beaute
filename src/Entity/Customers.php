<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
#[Vich\Uploadable]
#[ORM\Index(name: 'customers_idx', columns: ['first_name', 'last_name', 'email', 'phone'], flags: ['fulltext'])]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('email')]
class Customers
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $firstName = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $lastName = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $address = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $zipCode = null;

  #[ORM\Column(length: 255)]
  #[Assert\Email]
  private ?string $email = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $phone = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $avatar = null;

  // NOTE: This is not a mapped field of entity metadata, just a simple property.
  #[Vich\UploadableField(mapping: 'clients', fileNameProperty: 'avatar')]
  private ?File $imageFile = null;

  #[ORM\Column(length: 255, type: 'datetime', nullable: true)]
  private $createdAt;

  #[ORM\Column(length: 255, type: 'datetime', nullable: true)]
  private $updatedAt;

  #[ORM\ManyToMany(targetEntity: History::class, inversedBy: 'customers')]
  private Collection $historySoin;

  public function __construct()
  {
    $this->createdAt = new \DateTimeImmutable();
    $this->updatedAt = new \DateTimeImmutable();

    return $this;

    $this->historySoin = new ArrayCollection();
  }

  // public function __toString()
  // {
  //   return $this->historySoin;
  // }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getFirstName(): ?string
  {
    return $this->firstName;
  }

  public function setFirstName(string $firstName): self
  {
    $this->firstName = $firstName;

    return $this;
  }

  public function getLastName(): ?string
  {
    return $this->lastName;
  }

  public function setLastName(string $lastName): self
  {
    $this->lastName = $lastName;

    return $this;
  }

  public function getFullName(): ?string
  {
    return $this->lastName . ' ' . $this->firstName;
  }

  public function getAddress(): ?string
  {
    return $this->address;
  }

  public function setAddress(string $address): self
  {
    $this->address = $address;

    return $this;
  }

  public function getZipCode(): ?string
  {
    return $this->zipCode;
  }

  public function setZipCode(string $zipCode): self
  {
    $this->zipCode = $zipCode;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getPhone(): ?string
  {
    return $this->phone;
  }

  public function setPhone(string $phone): self
  {
    $this->phone = $phone;

    return $this;
  }

  public function getAvatar(): ?string
  {
    return $this->avatar;
  }

  public function setAvatar(?string $avatar): self
  {
    $this->avatar = $avatar;

    return $this;
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

  #[ORM\PrePersist]
  public function onPrePersist()
  {
    $this->createdAt = (new \DateTimeImmutable());
    //$this->updatedAt = (new \DateTimeImmutable());
  }

  #[ORM\PreUpdate]
  public function onPreUpdate()
  {
    $this->updatedAt = (new \DateTimeImmutable());
  }

  public function getCreatedAt(): ?\DateTimeInterface
  {
    return $this->createdAt;
  }

  public function setCreatedAt(\DateTimeInterface $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(\DateTimeInterface $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  /**
   * @return Collection<int, History>
   */
  public function getHistorySoin(): Collection
  {
    return $this->historySoin;
  }

  public function addHistorySoin(History $historySoin): self
  {
    if (!$this->historySoin->contains($historySoin)) {
      $this->historySoin->add($historySoin);
    }

    return $this;
  }

  public function removeHistorySoin(History $historySoin): self
  {
    $this->historySoin->removeElement($historySoin);

    return $this;
  }
}
