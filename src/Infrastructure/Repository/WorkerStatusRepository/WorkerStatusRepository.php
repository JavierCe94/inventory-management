<?php

namespace App\Infrastructure\Repository\WorkerStatusRepository;

use App\Domain\Model\Entity\WorkerStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkerStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkerStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkerStatus[]    findAll()
 * @method WorkerStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkerStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkerStatus::class);
    }

//    /**
//     * @return Worker[] Returns an array of Worker objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Worker
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
