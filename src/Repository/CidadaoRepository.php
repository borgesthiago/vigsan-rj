<?php

namespace App\Repository;

use App\Entity\Cidadao;
use App\Enum\EvolucaoEnum;
use App\Enum\InternacaoEnum;
use App\Enum\VentilacaoEnum;
use App\Enum\ResultadoExameEnum;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Cidadao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cidadao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cidadao[]    findAll()
 * @method Cidadao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CidadaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cidadao::class);
    }

    public function totalCidadaos()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaosResultadoExame()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.resultadoExame <> :exame')
            ->setParameter(':exame', ResultadoExameEnum::VAZIO)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaosResultadoExameDetectavel()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.resultadoExame <> :exame')
            ->setParameter(':exame', ResultadoExameEnum::DETECTAVEL)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }


    public function totalCidadaosUti()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.internacaoUti = :uti')
            ->setParameter(':uti', InternacaoEnum::SIM)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaosSivep()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.sivep IS NOT NULL')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaosEvolucaoAltas()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.evolucao = :evolucao')
            ->setParameter(':evolucao', EvolucaoEnum::ALTA)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaosEvolucaoObitos()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.evolucao = :evolucao')
            ->setParameter(':evolucao', EvolucaoEnum::OBITO)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaosEvolucaoTransferidos()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.evolucao = :evolucao')
            ->setParameter(':evolucao', EvolucaoEnum::TRANSFERIDO)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaosVentilacao()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.usoSuporteVentilatorio <> :ventilador')
            ->setParameter(':ventilador', VentilacaoEnum::NAO)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function totalCidadaoPorUnidade()
    {
        $entityManager = $this->getEntityManager();
        $rsm = new ResultSetMapping();
        $rsm
            ->addScalarResult('id', 'id')
            ->addScalarResult('total_pacientes', 'total_pacientes')
            ->addScalarResult('nome', 'nome')
        ;
        
        $qb = $entityManager->createNativeQuery(
            'SELECT 
                count(c.id) as total_pacientes,
                u.nome
            FROM
                app.cidadao c
                left join app.unidade u ON c.unidade_id = u.id
            group by u.id
            ',
                $rsm
            );
        return $qb
            ->getResult()
        ;
    }

    public function totalDataNotificacaoPorUnidade()
    {
        $entityManager = $this->getEntityManager();
        $rsm = new ResultSetMapping();
        $rsm
            ->addScalarResult('total', 'total')
            ->addScalarResult('dia', 'dia')
            ->addScalarResult('mes', 'mes')
            ->addScalarResult('ano', 'ano')
            ->addScalarResult('unidade', 'unidade')
        ;
        
        $qb = $entityManager->createNativeQuery(
            'SELECT 
                COUNT(c.id) AS total,
                DAY(c.data_notificacao) AS dia,
                MONTH(c.data_notificacao) AS mes,
                YEAR(c.data_notificacao) AS ano,
                u.nome as unidade
            FROM
                app.cidadao c
                left join app.unidade u on c.unidade_id = u.id
            GROUP BY c.data_notificacao, u.nome
            ',
                $rsm
            );
        return $qb
            ->getResult()
        ;
    }
}