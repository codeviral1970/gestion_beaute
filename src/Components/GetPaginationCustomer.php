<?php

namespace App\Components;

use App\Repository\CustomersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent('customer_pagination')]
class GetPaginationCustomer
{
  use DefaultActionTrait;

  #[LiveProp(writable: true)]
  public string $query = '';
  public int $page;

  public function __construct(
    private CustomersRepository $customersRepository,
    private PaginatorInterface $paginator
  ) {
  }

  public function getCustomerPaginator()
  {
    // $data = $this->customersRepository->findAll();
    // dd($data);
    // $pagination = $this->paginator->paginate(
    //   $data, /* query NOT result */
    //   $this->request->query->getInt('page', 1)/*page number*/,
    //   $this->request->query->getInt('limit', 10)/*limit per page*/
    // );

    // return $pagination;
    // return $this->customersRepository->findPage(1);
    return $this->customersRepository->findAll();
  }
}
