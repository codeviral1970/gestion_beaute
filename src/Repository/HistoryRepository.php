<?php

namespace App\Repository;

use App\Entity\History;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<History>
 *
 * @method History|null find($id, $lockMode = null, $lockVersion = null)
 * @method History|null findOneBy(array $criteria, array $orderBy = null)
 * @method History[]    findAll()
 * @method History[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, History::class);
    }

    public function findLastFiveHistory()
    {
        return $this->createQueryBuilder('n')
          ->orderBy('n.createdAt', 'DESC')
          ->setMaxResults(5)
          ->getQuery()
          ->getResult();
    }

    public function historyOrderByDesc()
    {
        return $this->createQueryBuilder('h')
          ->orderBy('h.createdAt', 'DESC')
          ->getQuery()
          ->getResult();
    }

    public function save(History $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(History $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

  //    /**
  //     * @return History[] Returns an array of History objects
  //     */
  //    public function findByExampleField($value): array
  //    {
  //        return $this->createQueryBuilder('h')
  //            ->andWhere('h.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->orderBy('h.id', 'ASC')
  //            ->setMaxResults(10)
  //            ->getQuery()
  //            ->getResult()
  //        ;
  //    }

  //    public function findOneBySomeField($value): ?History
  //    {
  //        return $this->createQueryBuilder('h')
  //            ->andWhere('h.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
