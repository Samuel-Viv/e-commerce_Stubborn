<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Service\StripeService;

class PayementControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $stripeServiceMock = $this->createMock(StripeService::class);

        $stripeServiceMock->method('createCheckoutSession')
            ->willReturn('https://stripe.com/checkout-session');

        $client->getContainer()->set(StripeService::class, $stripeServiceMock);

        $client->request('POST', '/stripe', [
            'cart' => [
                'name' => 'Blackbelt',
                'price' => 29.90,
                'quantity' => 1
            ]
        ]);

        // Vérifier que la redirection vers l'URL de Stripe est correcte
        $this->assertResponseRedirects('https://stripe.com/checkout-session');
    }
}
