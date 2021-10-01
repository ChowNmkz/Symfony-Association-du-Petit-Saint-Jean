<?php

namespace App\Repository;

use App\Entity\ImportPdf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImportPdf|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportPdf|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportPdf[]    findAll()
 * @method ImportPdf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportPdfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportPdf::class);
    }

    // /**
    //  * @return ImportPdf[] Returns an array of ImportPdf objects
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
    public function findOneBySomeField($value): ?ImportPdf
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
