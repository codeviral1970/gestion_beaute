<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ResetPassword
{
    #[Assert\NotBlank(message: 'Ce champ ne peut être vide')]
    private ?string $oldPassword = null;

    #[Assert\NotBlank(message: 'Ce champ ne peut être vide')]
    private ?string $newPassword = null;

    #[Assert\EqualTo(propertyPath: 'newPassword', message: 'Les mots de passe ne correspond pas !')]
    private ?string $confirmPassword = null;

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}
