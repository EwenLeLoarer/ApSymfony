<?php

namespace App\Repository;

use App\Entity\CarteFidelité;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarteFidelité>
 *
 * @method CarteFidelité|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteFidelité|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteFidelité[]    findAll()
 * @method CarteFidelité[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteFidelitéRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteFidelité::class);
    }

    public function save(CarteFidelité $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarteFidelité $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CarteFidelité[] Returns an array of CarteFidelité objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarteFidelité
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
