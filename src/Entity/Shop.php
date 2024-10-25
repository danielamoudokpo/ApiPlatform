<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\ShopController;
use App\Repository\ShopRepository;
use App\State\ShopStateProvider;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(

    operations: [
        new GetCollection(
            uriTemplate: '/shops/category/{category}',
            uriVariables: ['category'],
            provider: ShopStateProvider::class,
            normalizationContext: ['groups' => ['shop:read']],
        ),
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Delete()
    ],
    normalizationContext: ['groups' => ['shop:read']],
    denormalizationContext: ['groups' => ['shop:write']],
)]
#[ORM\Entity(repositoryClass: ShopRepository::class)]
#[ORM\Table(name: 'Shop')]
class Shop
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Auto-increment for integer IDs
    #[Groups(['shop:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['shop:read', 'shop:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['shop:read', 'shop:write'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['shop:read', 'shop:write'])]
    private ?string $ownerId = null;

    #[ORM\Column(length: 255)]
    #[Groups(['shop:read', 'shop:write'])]
    private ?string $categoryId = null;

    #[ORM\Column(length: 255)]
    #[Groups(['shop:read'])]
    private ?string $slug = null;

    // Getter for id
    public function getId(): ?int
    {
        return $this->id;
    }

    // Setter for id (optional since it's auto-generated)
    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    // Getter for name
    public function getName(): ?string
    {
        return $this->name;
    }

    // Setter for name
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    // Getter for description
    public function getDescription(): ?string
    {
        return $this->description;
    }

    // Setter for description
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    // Getter for ownerId
    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    // Setter for ownerId
    public function setOwnerId(string $ownerId): static
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    // Getter for categoryId
    public function getCategoryId(): ?string
    {
        return $this->categoryId;
    }

    // Setter for categoryId
    public function setCategoryId(string $categoryId): static
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    // Getter for slug
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    // Setter for slug
    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}

