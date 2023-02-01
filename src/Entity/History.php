<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class History
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(type: Types::TEXT)]
  private ?string $content = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $image = null;

  #[ORM\Column(length: 255)]
  private ?string $service = null;

  #[ORM\Column]
  private ?\DateTimeImmutable $createdAt = null;

  #[ORM\Column(length: 255, type: 'datetime', nullable: true)]
  private $updatedAt;

  #[ORM\ManyToMany(targetEntity: Customers::class, mappedBy: 'historySoin')]
  private Collection $customers;

  // NOTE: This is not a mapped field of entity metadata, just a simple property.
  #[Vich\UploadableField(mapping: 'slide', fileNameProperty: 'image')]
  private ?File $imageFile = null;

  // #[ORM\OneToMany(mappedBy: 'historySlide', targetEntity: ImgHistorySlide::class)]
  // private Collection $imgHistorySlides;

  public function __construct()
  {
    $this->createdAt = new \DateTimeImmutable();
    $this->updatedAt = new \DateTimeImmutable();
    $this->customers = new ArrayCollection();
    // $this->imgHistorySlides = new ArrayCollection();
  }


  #[ORM\PrePersist]
  public function onPrePersist()
  {
    $this->createdAt = (new \DateTimeImmutable());
  }

  #[ORM\PreUpdate]
  public function onPreUpdate()
  {
    $this->updatedAt = (new \DateTimeImmutable());
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getContent(): ?string
  {
    return $this->content;
  }

  public function setContent(string $content): self
  {
    $this->content = $content;

    return $this;
  }

  public function getCreatedAt(): ?\DateTimeImmutable
  {
    return $this->createdAt;
  }

  public function setCreatedAt(\DateTimeImmutable $createdAt): self
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

  public function getImage(): ?string
  {
    return $this->image;
  }

  public function setImage(?string $image): self
  {
    $this->image = $image;

    return $this;
  }

  public function getService(): ?string
  {
    return $this->service;
  }

  public function setService(string $service): self
  {
    $this->service = $service;

    return $this;
  }

  /**
   * @return Collection<int, Customers>
   */
  public function getCustomers(): Collection
  {
    return $this->customers;
  }

  public function addCustomer(Customers $customer): self
  {
    if (!$this->customers->contains($customer)) {
      $this->customers->add($customer);
      $customer->addHistorySoin($this);
    }

    return $this;
  }

  public function removeCustomer(Customers $customer): self
  {
    if ($this->customers->removeElement($customer)) {
      $customer->removeHistorySoin($this);
    }

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
}
