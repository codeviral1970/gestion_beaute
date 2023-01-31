<?php

namespace App\Entity;

use App\Repository\ImgHistorySlideRepository;
use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\HttpFoundation\File\File;
// use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImgHistorySlideRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ImgHistorySlide
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $slideName = null;

  #[ORM\Column(length: 255, type: 'datetime', nullable: true)]
  private $updatedAt;

  #[ORM\ManyToOne(inversedBy: 'imgHistorySlides')]
  private ?History $historySlide = null;


  #[ORM\PreUpdate]
  public function onPreUpdate()
  {
    $this->updatedAt = (new \DateTimeImmutable());
  }

  public function getId(): ?int
  {
    return $this->id;
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

  public function getSlideName()
  {
    return $this->slideName;
  }

  public function setSlideName($slideName)
  {
    $this->slideName = $slideName;

    return $this;
  }

  public function getHistorySlide(): ?History
  {
    return $this->historySlide;
  }

  public function setHistorySlide(?History $historySlide): self
  {
    $this->historySlide = $historySlide;

    return $this;
  }
}
