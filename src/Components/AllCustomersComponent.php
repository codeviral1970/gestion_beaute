<?php

namespace App\Components;

use App\Entity\Customers;
use App\Repository\CustomersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;


#[AsTwigComponent('all_customers')]
class AllCustomersComponent
{
    private int $id;

    public function __construct(
        private CustomersRepository $customersRepository,
        private PaginatorInterface $paginator)
    {}

    public function getAllCustomer() : Array
    {
        // $data = $this->customersRepository->findAll();
        // $pagination = $this->paginator->paginate(
        //     $data,
        //     $request->query->getInt('page', 1), /* page number */
        //     8
        // );
        return $this->customersRepository->findAll();
    }
}