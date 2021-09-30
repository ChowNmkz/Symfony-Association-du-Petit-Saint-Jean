<?php

namespace App\Repository;

use App\Entity\CommerceQuartier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommerceQuartier|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommerceQuartier|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommerceQuartier[]    findAll()
 * @method CommerceQuartier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommerceQuartierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommerceQuartier::class);
    }

    // /**
    //  * @return CommerceQuartier[] Returns an array of CommerceQuartier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommerceQuartier
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
