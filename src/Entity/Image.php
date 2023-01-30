<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\HttpFoundation\File\File;
// use Vich\UploaderBundle\Mapping\Annotation as Vich;
// use Symfony\Component\HttpFoundation\File\UploadedFile;


#[ORM\Entity(repositoryClass: ImageRepository::class)]

class Image
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $imageName = null;

  // NOTE: This is not a mapped field of entity metadata, just a simple property.
  // #[Vich\UploadableField(mapping: 'profile', fileNameProperty: 'imageName')]
  // private ?File $imageFile = null;

  #[ORM\Column(length: 255, type: 'datetime', nullable: true)]
  private $updatedAt;

  #[ORM\OneToOne(mappedBy: 'userAvatar', cascade: ['persist', 'remove'])]
  private ?User $user = null;

  #[ORM\PreUpdate]
  public function onPreUpdate()
  {
    $this->updatedAt = (new \DateTimeImmutable());
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getImageName(): ?string
  {
    return $this->imageName;
  }

  public function setImageName(?string $imageName): self
  {
    $this->imageName = $imageName;

    return $this;
  }

  // /**
  //  * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
  //  * of 'UploadedFile' is injected into this setter to trigger the update. If this
  //  * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
  //  * must be able to accept an instance of 'File' as the bundle will inject one here
  //  * during Doctrine hydration.
  //  *
  //  * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
  //  */
  // public function setImageFile(?File $imageFile = null): void
  // {
  //   $this->imageFile = $imageFile;

  //   if (null !== $imageFile) {
  //     // It is required that at least one field changes if you are using doctrine
  //     // otherwise the event listeners won't be called and the file is lost
  //     $this->updatedAt = new \DateTimeImmutable();
  //   }
  // }

  // public function getImageFile(): ?File
  // {
  //   return $this->imageFile;
  // }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(\DateTimeInterface $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  public function getUser(): ?User
  {
    return $this->user;
  }

  public function setUser(?User $user): self
  {
    // unset the owning side of the relation if necessary
    if ($user === null && $this->user !== null) {
      $this->user->setUserAvatar(null);
    }

    // set the owning side of the relation if necessary
    if ($user !== null && $user->getUserAvatar() !== $this) {
      $user->setUserAvatar($this);
    }

    $this->user = $user;

    return $this;
  }

  public function __serialize(): array
  {
    return [
      'imageName' => $this->imageName,
      'updatedAt' => $this->updatedAt,
    ];
  }

  public function __unserialize(array $serialized)
  {
    $this->imageName = $serialized['imageName'];
    $this->updatedAt = $serialized['updatedAt'];
    return $this;
  }
}
