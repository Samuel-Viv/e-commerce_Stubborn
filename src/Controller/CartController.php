<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;


class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart', methods:['GET'])]
    public function index(SessionInterface $session): Response
    {   
        //On recupére la session
        $cart = $session->get('cart', []);

         // Calculer le total du panier
        $total = array_reduce($cart, function ($total, $item) {
            return $total + $item['price'] * $item['quantity'];
        }, 0);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    #[Route('/add/{id}', name:'cart_add', methods:['POST'])]
    public function add(Request $request,Product $product, SessionInterface $session)
    {  
        //On récupére la taille séléctionne dans le formulaire
        $size = $request->request->get('size');

        // On vérifie que la taille a bien été sélectionnée
        if (!in_array($size, ['XS', 'S', 'M', 'L', 'XL'])) {
            $this->addFlash('error', 'Taille non valide');
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }


        //Flag pour savoir si le produit exixte dans le panier
        $productAlreadyInCart = false;

        //Récupération ou initialisatin du panier
        $cart = $session->get('cart', []);

               // Parcourir le panier pour voir si le produit avec la taille sélectionnée existe déjà
               foreach ($cart as &$item) {
                if ($item['id'] === $product->getId() && $item['size'] === $size) {
                    // Si le produit est déjà dans le panier, on incrémente la quantité
                    $item['quantity']++;
                    $productAlreadyInCart = true;
                    break;
                }
            }
    
            // Si le produit n'existe pas dans le panier, on l'ajoute
            if (!$productAlreadyInCart) {
                $cart[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'price' => $product->getPrice(),
                    'image' => $product->getImage(),
                    'size' => $size,
                    'quantity' => 1, // Initialisation de la quantité à 1
                ];
            }
        //On met a jour la session
        $session->set('cart', $cart);

        $this->addFlash('success', 'Le produit à été ajouté au panier ! ');

        //Redirection après l'ajout du produits
        return $this->redirectToRoute('app_cart');
    }


    #[Route('/remover/{id}/{size}', name:'cart_remove', methods:['GET'])]
    public function remove(int $id,string $size, SessionInterface $session)
    {  

        //Récupération ou initialisation du panier
        $cart = $session->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] === $id && $item['size'] === $size) {
                unset($cart[$key]);
                break;
            }
        }
    
        //On met a jour la session
        $session->set('cart', array_values($cart));

        //Redirection après l'ajout du produits
        return $this->redirectToRoute('app_cart');
    }
}
