<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use App\Service\StripeService;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PayementController extends AbstractController
{
    #[Route('/stripe', name: 'app_stripe')]
    public function stripe(SessionInterface $session, StripeService $stripeService):RedirectResponse
    {

        //Recupération du panier depuis la session 
        $cart = $session->get('cart', []);
        //Si le panier est vide retourne a la page panier
        if (empty($cart)) {
            return $this->redirectToRoute('app_cart');
        }

        // Utiliser le service Stripe pour créer une session de paiement
        $checkoutUrl = $stripeService->createCheckoutSession($cart);

        // Redirection vers Stripe pour finaliser la commande
        return new RedirectResponse($checkoutUrl, 201);
    }

    #[Route('/success', name: 'payment_success', methods:['GET'])]
    public function success(): Response
    {
        return $this->render('stripe/success.html.twig');
    }

    #[Route('/cancel', name: 'payment_cancel', methods:['GET'])]
    public function cancel(): Response
    {
        return $this->render('stripe/cancel.html.twig');
    }
}
