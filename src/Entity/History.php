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

  #[ORM\OneToMany(mappedBy: 'historySlide', targetEntity: ImgHistorySlide::class)]
  private Collection $imgHistorySlides;

  public function __construct()
  {
    $this->createdAt = new \DateTimeImmutable();
    $this->updatedAt = new \DateTimeImmutable();
    $this->customers = new ArrayCollection();
    $this->imgHistorySlides = new ArrayCollection();
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
   * @return Collection<int, ImgHistorySlide>
   */
  public function getImgHistorySlides(): Collection
  {
      return $this->imgHistorySlides;
  }

  public function addImgHistorySlide(ImgHistorySlide $imgHistorySlide): self
  {
      if (!$this->imgHistorySlides->contains($imgHistorySlide)) {
          $this->imgHistorySlides->add($imgHistorySlide);
          $imgHistorySlide->setHistorySlide($this);
      }

      return $this;
  }

  public function removeImgHistorySlide(ImgHistorySlide $imgHistorySlide): self
  {
      if ($this->imgHistorySlides->removeElement($imgHistorySlide)) {
          // set the owning side to null (unless already changed)
          if ($imgHistorySlide->getHistorySlide() === $this) {
              $imgHistorySlide->setHistorySlide(null);
          }
      }

      return $this;
  }
}
