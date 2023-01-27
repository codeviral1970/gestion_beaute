<?php

namespace App\Components;

use App\Entity\Customers;
use App\Repository\CustomersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[AsTwigComponent('all_customers')]
class AllCustomersComponent extends AbstractController
{
  private int $id;

  public function __construct(
    private CustomersRepository $customersRepository,
    private PaginatorInterface $paginator
  ) {
  }

  public function getAllCustomer()
  {
    // $data = $this->customersRepository->findAll();
    // $pagination = $this->paginator->paginate(
    //   $data, /* query NOT result */
    //   $this->request->query->getInt('page', 1)/*page number*/,
    //   $this->request->query->getInt('limit', 10)/*limit per page*/
    // );

    // return $pagination;

    return $this->customersRepository->findAll();
  }
}
