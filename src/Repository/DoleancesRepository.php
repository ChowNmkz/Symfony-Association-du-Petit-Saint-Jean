<?php

namespace App\Repository;

use App\Entity\Doleances;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Doleances|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doleances|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doleances[]    findAll()
 * @method Doleances[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoleancesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doleances::class);
    }

    // /**
    //  * @return Doleances[] Returns an array of Doleances objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Doleances
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
