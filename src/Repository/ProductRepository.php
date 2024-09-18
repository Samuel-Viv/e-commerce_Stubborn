<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByPriceRangeCategory($category)
    {
        // Création d'une instance de QueryBuilder pour l'entité Product
        $qb = $this->createQueryBuilder('p');

        // Ajout des conditions selon la catégorie de prix
        switch ($category) {
            case '10-30':
                $qb->andWhere('p.price >= :minPrice')
                   ->andWhere('p.price <= :maxPrice')
                   ->setParameter('minPrice', 10)
                   ->setParameter('maxPrice', 30);
                break;

            case '30-35':
                $qb->andWhere('p.price >= :minPrice')
                   ->andWhere('p.price <= :maxPrice')
                   ->setParameter('minPrice', 30)
                   ->setParameter('maxPrice', 35);
                break;

            case '35-50':
                $qb->andWhere('p.price >= :minPrice')
                   ->andWhere('p.price <= :maxPrice')
                   ->setParameter('minPrice', 35)
                   ->setParameter('maxPrice', 60);
                break;

            default:
                // Aucun filtre si la catégorie n'est pas reconnue
                break;
        }

        // Exécution de la requête et retour des résultats
        return $qb->getQuery()->getResult();
    }
}

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

