<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource()]
#[ORM\Table(name: 'Reservation')]
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Use auto-increment for integer IDs
    #[ORM\Column(type: 'integer', unique: true)]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column]
    private ?int $serviceId = null;

    #[ORM\Column]
    private ?int $userId = null;

    #[ORM\Column]
    private ?bool $isCancelled = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $serviceId): static
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function isIsCancelled(): ?bool
    {
        return $this->isCancelled;
    }

    public function setIsCancelled(bool $isCancelled): static
    {
        $this->isCancelled = $isCancelled;

        return $this;
    }
}
