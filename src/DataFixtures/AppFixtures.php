<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin -> setName('John Doe');
        $admin -> setEmail('johndoe@gmail.com');
        $admin -> setPassword($this->passwordHasher->hashPassword($admin, 'admin12345'));
        $admin -> setRoles(['ROLE_ADMIN']);
        $manager -> persist($admin);

        $user = new User();
        $user -> setName('Jane Doe');
        $user -> setEmail('janndoe@gmail.com');
        $user -> setPassword($this->passwordHasher->hashPassword($user, '012345'));
        $user -> setDeliveryAddress('15 rue des lilas, 86130 jaunay-marigny');
        $user -> setRoles(['ROLE_USER']);
        $manager -> persist($user);

        $blackbelt = new Product();
        $blackbelt->setName('Blackbelt');
        $blackbelt->setPrice(29.9);
        $blackbelt->setStockXS(2);
        $blackbelt->setStockS(2);
        $blackbelt->setStockM(2);
        $blackbelt->setStockL(2);
        $blackbelt->setStockXL(2);
        $blackbelt->setImage('1-66e82d624e3d4.jpg');
        $manager->persist($blackbelt);

        $bleubelt = new Product();
        $bleubelt->setName('Bleubelt');
        $bleubelt->setPrice(29.9);
        $bleubelt->setStockXS(2);
        $bleubelt->setStockS(2);
        $bleubelt->setStockM(2);
        $bleubelt->setStockL(2);
        $bleubelt->setStockXL(2);
        $bleubelt->setImage('2-66e82d8685e64.jpg');
        $manager->persist($bleubelt);

        $street = new Product();
        $street->setName('Street');
        $street->setPrice(35.5);
        $street->setStockXS(2);
        $street->setStockS(2);
        $street->setStockM(2);
        $street->setStockL(2);
        $street->setStockXL(2);
        $street->setImage('3-66e82da1de948.jpg');
        $manager->persist($street);

        $pokeball = new Product();
        $pokeball->setName('Pokeball');
        $pokeball->setPrice(45);
        $pokeball->setStockXS(2);
        $pokeball->setStockS(2);
        $pokeball->setStockM(2);
        $pokeball->setStockL(2);
        $pokeball->setStockXL(2);
        $pokeball->setImage('4-66e82db8aa6bb.jpg');
        $manager->persist($pokeball);

        $pinklady = new Product();
        $pinklady->setName('PinkLady');
        $pinklady->setPrice(29.9);
        $pinklady->setStockXS(2);
        $pinklady->setStockS(2);
        $pinklady->setStockM(2);
        $pinklady->setStockL(2);
        $pinklady->setStockXL(2);
        $pinklady->setImage('5-66e82dd41d9c4.jpg');
        $manager->persist($pinklady);

        $snow = new Product();
        $snow->setName('Snow');
        $snow->setPrice(32);
        $snow->setStockXS(2);
        $snow->setStockS(2);
        $snow->setStockM(2);
        $snow->setStockL(2);
        $snow->setStockXL(2);
        $snow->setImage('6-66e82ded0959d.jpg');
        $manager->persist($snow);

        $greyback = new Product();
        $greyback->setName('GreyBack');
        $greyback->setPrice(28.5);
        $greyback->setStockXS(2);
        $greyback->setStockS(2);
        $greyback->setStockM(2);
        $greyback->setStockL(2);
        $greyback->setStockXL(2);
        $greyback->setImage('7-66e82e1d5de30.jpg');
        $manager->persist($greyback);

        $bleucould = new Product();
        $bleucould->setName('BleuCould');
        $bleucould->setPrice(45);
        $bleucould->setStockXS(2);
        $bleucould->setStockS(2);
        $bleucould->setStockM(2);
        $bleucould->setStockL(2);
        $bleucould->setStockXL(2);
        $bleucould->setImage('8-66e82e35afd21.jpg');
        $manager->persist($bleucould);

        $borninusa = new Product();
        $borninusa->setName('BornInUsa');
        $borninusa->setPrice(59);
        $borninusa->setStockXS(2);
        $borninusa->setStockS(2);
        $borninusa->setStockM(2);
        $borninusa->setStockL(2);
        $borninusa->setStockXL(2);
        $borninusa->setImage('9-66e82e7bad724.jpg');
        $manager->persist($borninusa);

        $greenschool = new Product();
        $greenschool->setName('GreenSchool');
        $greenschool->setPrice(42.2);
        $greenschool->setStockXS(2);
        $greenschool->setStockS(2);
        $greenschool->setStockM(2);
        $greenschool->setStockL(2);
        $greenschool->setStockXL(2);
        $greenschool->setImage('10-66e82e9cc9fe3.jpg');
        $manager->persist($greenschool);

        $manager->flush();
    }
}
