<?php

namespace App\Service;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class StripeService{

    
    public function __construct()
    {   
         //Récupération de la clé secrete de stripe(fichier .env)
         Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
         Stripe::setApiVersion('2024-06-20');
    }

    /**
     * Créer une session Stripe pour le paiement.
     *
     * @param array $cart Le panier de l'utilisateur.
     * @return string URL de la session Stripe Checkout.
     */
    public function createCheckoutSession(array $cart):string
    {
        $lineItems =[];

        foreach ($cart as $item){
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount'=> $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        
        //Création d'une session Stripe Checkout
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/success',
            'cancel_url' => 'http://localhost:8000/cancel', 
        ]);


        return $checkout_session -> url;
    }
}