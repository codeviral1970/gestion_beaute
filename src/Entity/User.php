<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
#[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 180, unique: true)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  #[Assert\Email]
  private ?string $email = null;

  #[ORM\Column]
  private array $roles = [];

  /**
   * @var string The hashed password
   */
  #[ORM\Column]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $password = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $firstName = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $lastName = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $avatar = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $address = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $zipCode = null;

  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: "Ce champ ne peut être vide")]
  private ?string $phone = null;

  #[ORM\Column(length: 255, type: 'datetime', nullable: true)]
  private $createdAt;

  #[ORM\Column(length: 255, type: 'datetime', nullable: true)]
  private $updatedAt;

  // NOTE: This is not a mapped field of entity metadata, just a simple property.
  #[Vich\UploadableField(mapping: 'profile', fileNameProperty: 'avatar')]
  private ?File $imageFile = null;

  public function __construct()
  {
    $this->createdAt = new \DateTimeImmutable();
    $this->updatedAt = new \DateTimeImmutable();

    return $this;
  }

  public function getId(): ?int
  {
    return $this->id;
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

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUserIdentifier(): string
  {
    return (string) $this->email;
  }

  /**
   * @see UserInterface
   */
  public function getRoles(): array
  {
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }

  public function setRoles(array $roles): self
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see PasswordAuthenticatedUserInterface
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function eraseCredentials()
  {
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
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

  public function getFullName()
  {
    return $this->getFirstName() . ' ' . $this->getLastName();
  }

  public function setLastName(string $lastName): self
  {
    $this->lastName = $lastName;

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

  public function getPhone(): ?string
  {
    return $this->phone;
  }

  public function setPhone(string $phone): self
  {
    $this->phone = $phone;

    return $this;
  }

  #[ORM\PrePersist]
  public function onPrePersist()
  {
    $this->createdAt = (new \DateTimeImmutable());
    $this->updatedAt = (new \DateTimeImmutable());
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

  public function __serialize(): array
  {
    return [
      'id' => $this->id,
      'email' => $this->email,
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'address' => $this->address,
      'zipCode' => $this->zipCode,
      'phone' => $this->phone,
      'avatar' => $this->avatar,
      'imageFile' => $this->imageFile,
      'updatedAt' => $this->updatedAt,
      'roles' => $this->roles,
      'createdAt' => $this->createdAt,
      'password' => $this->password,
    ];
  }

  public function __unserialize(array $serialized)
  {
    $this->id = $serialized['id'];
    $this->email = $serialized['email'];
    $this->firstName = $serialized['firstName'];
    $this->lastName = $serialized['lastName'];
    $this->address = $serialized['address'];
    $this->zipCode = $serialized['zipCode'];
    $this->phone = $serialized['phone'];
    $this->avatar = $serialized['avatar'];
    $this->imageFile = $serialized['imageFile'];
    $this->updatedAt = $serialized['updatedAt'];
    $this->roles = $serialized['roles'];
    $this->createdAt = $serialized['createdAt'];
    $this->password = $serialized['password'];

    return $this;
  }
}
