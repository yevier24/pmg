<?php

namespace App\Repository;

use App\Entity\Carga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Carga|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carga|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carga[]    findAll()
 * @method Carga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CargaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carga::class);
    }

    // /**
    //  * @return Carga[] Returns an array of Carga objects
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
    public function findOneBySomeField($value): ?Carga
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
