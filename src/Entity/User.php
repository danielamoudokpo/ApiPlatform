<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use App\State\UserStateProvider;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/auth/me',
            provider: UserStateProvider::class,
            normalizationContext: ['groups' => ['me:read']],
        ),
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Delete()
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']],
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'User')]
#[UniqueEntity(['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Use auto-increment for integer IDs
    #[Groups(['me:read', 'user:read'])]
    private ?int $id = null; // Change from Uuid to integer

    #[ORM\Column(length: 255)]
    #[Groups(['me:read', 'user:read'])]
    private ?string $email = null;

    #[Groups(['me:read', 'user:read'])]
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[Groups(['me:read', 'user:read'])]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[Groups(['me:read', 'user:read'])]
    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    #[Groups(['me:read', 'user:read'])]
    private ?bool $isEmailVerified = null;

    // Getter for ID
    public function getId(): ?int
    {
        return $this->id; // Updated to return int
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isIsEmailVerified(): ?bool
    {
        return $this->isEmailVerified;
    }

    public function setIsEmailVerified(bool $isEmailVerified): static
    {
        $this->isEmailVerified = $isEmailVerified;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->firstname;
    }

    public function getRoles(): array
    {
        // Guarantee every user has at least ROLE_USER
        return [$this->role]; // Ensure it's an array
    }

    public function eraseCredentials()
    {
        // Implement eraseCredentials() method if needed
    }
}
