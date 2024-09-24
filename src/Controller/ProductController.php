<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'app_products', methods:['GET'])]
    public function index(Request $request, ProductRepository $repository): Response
    {
        // Récupérer la catégorie de prix à partir des paramètres de requête (GET)
    $priceCategory = $request->query->get('price_category');

    // Si une catégorie de prix est spécifiée, utiliser la méthode de filtrage, sinon récupérer tous les produits
    if ($priceCategory) {
        $products = $repository->findByPriceRangeCategory($priceCategory);
    } else {
        $products = $repository->findAll();
    }
        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/products/{id}', name:'product.show', methods: ["GET"])]
    public function show(Request $request, int $id,  ProductRepository $repository): Response
    {
        $product = $repository -> find($id);
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
