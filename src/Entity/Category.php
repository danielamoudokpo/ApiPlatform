<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource()]
#[ORM\Table(name: 'Category')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'ipartial'])]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Use auto-increment for integer IDs
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null; // Change to int

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function getId(): ?int // Adjust return type to int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
