<?php

namespace App\Repository;

use App\Entity\Customers;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Customers>
 *
 * @method Customers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customers[]    findAll()
 * @method Customers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersRepository extends ServiceEntityRepository
{

  public function __construct(
    ManagerRegistry $registry,
    private PaginatorInterface $paginatorInterface
  ) {
    parent::__construct($registry, Customers::class);
  }

  /**
   * @param int $page
   * @return PaginatorInterface
   */
  public function findByPage(int $page): PaginationInterface
  {
    $data = $this->createQueryBuilder('p')
      ->andWhere('p.firstName LIKE :query')
      ->setParameter('query', '%' . $page . '%')
      ->getQuery()
      ->getResult();

    $customer = $this->paginatorInterface->paginate(
      $data,
      $page,
      6
    );

    return $customer;
  }

  public function findByQuery(string $query): array
  {
    if (empty($query)) {
      return [];
    }
    return $this->createQueryBuilder('p')
      ->andWhere('p.firstName LIKE :query')
      ->setParameter('query', '%' . $query . '%')
      ->getQuery()
      ->getResult();
  }

  public function save(Customers $entity, bool $flush = false): void
  {
    $this->getEntityManager()->persist($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove(Customers $entity, bool $flush = false): void
  {
    $this->getEntityManager()->remove($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }
}
