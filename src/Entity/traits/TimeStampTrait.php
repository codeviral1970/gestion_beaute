<?php

namespace App\Entity\traits;

use Doctrine\ORM\Mapping as ORM;
use ORM\PrePersist;
use ORM\PreUpdate;

trait TimeStampTrait
{
    /**
     * @ORM\Column(type="datetime", nullable=true })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true })
     */
    private $updatedAt;

    /**
     * @PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = (new \DateTimeImmutable());
        $this->updatedAt = (new \DateTimeImmutable());
    }

    /**
     * @PreUpdate
     */
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
}
