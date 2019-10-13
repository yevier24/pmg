<?php

namespace App\Repository;

use App\Entity\CargaMeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CargaMeta|null find($id, $lockMode = null, $lockVersion = null)
 * @method CargaMeta|null findOneBy(array $criteria, array $orderBy = null)
 * @method CargaMeta[]    findAll()
 * @method CargaMeta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CargaMetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CargaMeta::class);
    }

    // /**
    //  * @return CargaMeta[] Returns an array of CargaMeta objects
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
    public function findOneBySomeField($value): ?CargaMeta
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
