<?php

namespace App\Repository;

use App\Entity\ImportPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImportPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportPhoto[]    findAll()
 * @method ImportPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportPhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportPhoto::class);
    }

    // /**
    //  * @return ImportPhoto[] Returns an array of ImportPhoto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImportPhoto
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
