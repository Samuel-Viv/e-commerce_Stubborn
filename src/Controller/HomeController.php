<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(ProductRepository $repository): Response
    {
        $product1 = $repository->findOneBy(['name' => 'Blackbelt']);
        $product2 = $repository->findOneBy(['name' => 'Pokeball']);
        $product3 = $repository->findOneBy(['name' => 'BornInUsa']);
        return $this->render('home/index.html.twig', [
            'products' => [$product1, $product2, $product3],
        ]);
    }
}
