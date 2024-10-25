<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ShopRepository;
use App\Repository\CategoryRepository; // Import the Category repository
use Symfony\Component\Uid\Uuid;

class ShopStateProvider implements ProviderInterface
{
    private ShopRepository $shopRepository;
    private CategoryRepository $categoryRepository; // Declare Category repository

    public function __construct(ShopRepository $shopRepository, CategoryRepository $categoryRepository)
    {
        $this->shopRepository = $shopRepository;
        $this->categoryRepository = $categoryRepository; // Initialize Category repository
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?array
    {
        // If the operation is for a collection (like fetching by category)
        if (isset($uriVariables['category'])) {
            $categorySlug = $uriVariables['category'];

            // First, find the category by its slug
            $category = $this->categoryRepository->findOneBy(['slug' => $categorySlug]);

            // If category is found, fetch shops by its ID
            if ($category) {
                return $this->shopRepository->findByCategory($category->getId());
            }
        }

        return null; // Return null if no category is found
    }
}
