<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{
    public function testAddMultipleProductsToCart(): void
    {
        // Créer un client pour simuler une requête HTTP
        $client = static::createClient();

        // Ajouter le premier produit (ID 1) avec la taille M
        $client->request('POST', '/add/1', [
            'size' => 'M',
        ]);

        // Vérification la redirection après l'ajout du produit
        $this->assertResponseRedirects('/cart');

        // Récupération la session après la première requête
        $session = $client->getRequest()->getSession();
        $cart = $session->get('cart', []);

        // Vérifiecation que le premier produit a bien été ajouté au panier
        $this->assertCount(1, $cart);
        $this->assertSame(1, $cart[0]['id']);
        $this->assertSame('M', $cart[0]['size']);
        $this->assertSame(1, $cart[0]['quantity']);

        // Ajouter d'un meme produit taille M
        $client->request('POST', '/add/1', [
            'size' => 'M',
        ]);

        $this->assertResponseRedirects('/cart');

        $session = $client->getRequest()->getSession();
        $cart = $session->get('cart', []);

        $this->assertCount(1, $cart);
        $this->assertSame(1, $cart[0]['id']);
        $this->assertSame('M', $cart[0]['size']);
        $this->assertSame(2, $cart[0]['quantity']);


        // Ajouter un autre produit (ID 2) avec la taille L
        $client->request('POST', '/add/2', [
            'size' => 'L',
        ]);

        $this->assertResponseRedirects('/cart');

        $session = $client->getRequest()->getSession();
        $cart = $session->get('cart', []);

        $this->assertCount(2, $cart);

        // Vérifier les détails du premier produit
        $this->assertSame(1, $cart[0]['id']);
        $this->assertSame('M', $cart[0]['size']);
        $this->assertSame(2, $cart[0]['quantity']);

        // Vérifier les détails du deuxième produit
        $this->assertSame(2, $cart[1]['id']);
        $this->assertSame('L', $cart[1]['size']);
        $this->assertSame(1, $cart[1]['quantity']);
    }


    public function testIndex(): void
    {
        $client = static::createClient();

        // Ajout des produits
        $client->request('POST', '/add/1', ['size' => 'M']);
        $client->request('POST', '/add/2', ['size' => 'L']);

        $session = $client->getRequest()->getSession();
        $cart = $session->get('cart', []);

        // Vérification du total des produits
        $total = array_reduce($cart, function ($total, $item) {
            return $total + $item['price'] * $item['quantity'];
        }, 0);

        $this->assertSame(59.8, $total); // Vérifie que le total est 30
    }

    public function testRemove(): void
    {
        $client = static::createClient();

        // Ajout des produits
        $client->request('POST', '/add/1', ['size' => 'M']);
        $client->request('POST', '/add/1', ['size' => 'M']);
        $client->request('POST', '/add/2', ['size' => 'L']);

        //Retirer le produit 1
        $client->request('GET', '/remover/1/M');

        //Redirection 
        $this->assertResponseRedirects('/cart');

        //Véricication de la suppression du produit
        $session = $client->getRequest()->getSession();
        $cart = $session->get('cart', []);

        $this->assertCount(1,$cart);
        $this->assertSame(2,$cart[0]['id']);
        $this->assertSame('L',$cart[0]['size']);
    }
}
