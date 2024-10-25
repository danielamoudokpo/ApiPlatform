<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HourRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Table(name: 'Hour')]
#[ORM\Entity(repositoryClass: HourRepository::class)]
class Hour
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Use auto-increment for integer IDs
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $start = null;

    #[ORM\Column(length: 255)]
    private ?string $end = null;

    #[ORM\Column]
    private ?int $day = null;

    #[ORM\Column]
    private ?int $shopId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(string $end): static
    {
        $this->end = $end;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(int $shopId): static
    {
        $this->shopId = $shopId;

        return $this;
    }
}
