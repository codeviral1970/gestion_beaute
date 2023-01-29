<?php

namespace App\Repository;

use App\Entity\ImgHistorySlide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImgHistorySlide>
 *
 * @method ImgHistorySlide|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImgHistorySlide|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImgHistorySlide[]    findAll()
 * @method ImgHistorySlide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImgHistorySlideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImgHistorySlide::class);
    }

    public function save(ImgHistorySlide $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ImgHistorySlide $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ImgHistorySlide[] Returns an array of ImgHistorySlide objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImgHistorySlide
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
