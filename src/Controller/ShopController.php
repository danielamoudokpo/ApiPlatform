<?php

namespace App\Controller;

use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShopController extends AbstractController
{
    private ShopRepository $shopRepository;

    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    // Method to fetch shops by category
    public function getShopsByCategory(string $category): JsonResponse
    {
        $shops = $this->shopRepository->findByCategory($category);

        if (!$shops) {
            throw new NotFoundHttpException('No shops found for this category.');
        }

        return $this->json($shops);
    }
}
