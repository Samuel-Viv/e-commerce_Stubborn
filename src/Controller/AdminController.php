<?php

// src/Controller/AdminController.php
namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_create')]
    public function create(ProductRepository $productRepository, Request $request, EntityManagerInterface $em): Response
    {
        $newProduct = new Product;
        $products = $productRepository->findAll();

        $formCreate = $this->createForm(ProductType::class, $newProduct);
        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {
            $em->persist($newProduct);
            $em->flush();
            $this->addFlash('success', 'Le produit à été créer !');
            return $this->redirectToRoute('admin_create');
        }

        $formsProduct = [];
        foreach ($products as $product) {
            $form = $this->createForm(ProductType::class, $product, [
                'action' => $this->generateUrl('update_product', ['id' => $product->getId()]),
                'method' => 'POST'
            ]);
            $formsProduct[$product->getId()] = $form->createView();
        }

        return $this->render('admin/index.html.twig', [
            'formCreate' => $formCreate,
            'products' => $products,
            'formsProduct' => $formsProduct
        ]);
    }

    #[Route('/admin/update/{id}', name: 'update_product')]
    public function update(Request $request, ProductRepository $repository, int $id, EntityManagerInterface $em): Response
    {
        $product = $repository->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Aucun produit trouvé avec l\'ID ' . $id);
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->flush();

            // Ajout d'un flash message pour informer de la modification réussie
            $this->addFlash('success', 'Le produit a été modifié avec succès !');

            // Redirection vers la page d'administration après la mise à jour
            return $this->redirectToRoute('admin_create');
        }

        // Si le formulaire n'est pas valide ou n'a pas été soumis, on peut rediriger vers la page d'édition avec l'objet produit
        return $this->render('admin/edit_product.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }
}
