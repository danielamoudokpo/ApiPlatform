<?php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;

class UserStateProvider implements ProviderInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
    $this->security = $security;
}

public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?User
    {
    // Get the authenticated user
    $user = $this->security->getUser();

    if (!$user instanceof User) {
    return null; // Handle cases where the user is not authenticated
    }

    return $user; // Return the authenticated user
    }
}
