<?php

namespace App\Repository;

use App\Entity\Unidade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Unidade|null find($id, $lockMode = null, $lockVersion = null)
 * @method Unidade|null findOneBy(array $criteria, array $orderBy = null)
 * @method Unidade[]    findAll()
 * @method Unidade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnidadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unidade::class);
    }
    
    public function totalUnidades()
    {
        return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Unidade
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
