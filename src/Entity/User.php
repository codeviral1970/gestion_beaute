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

  #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
  private ?Image $userAvatar = null;

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

  // public function getAvatar(): ?string
  // {
  //   return $this->avatar;
  // }

  // public function setAvatar(?string $avatar): self
  // {
  //   $this->avatar = $avatar;

  //   return $this;
  // }

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

  public function getUserAvatar(): ?Image
  {
    return $this->userAvatar;
  }

  public function setUserAvatar(?Image $userAvatar): self
  {
    $this->userAvatar = $userAvatar;

    return $this;
  }
}
