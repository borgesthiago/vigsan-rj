<?php

namespace App\Repository;

use App\Entity\Comorbidade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Comorbidade|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comorbidade|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comorbidade[]    findAll()
 * @method Comorbidade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComorbidadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comorbidade::class);
    }

    // /**
    //  * @return Comorbidade[] Returns an array of Comorbidade objects
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
    public function findOneBySomeField($value): ?Comorbidade
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
