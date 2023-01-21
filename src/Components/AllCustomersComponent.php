<?php

namespace App\Components;

use App\Entity\Customers;
use App\Repository\CustomersRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;


#[AsTwigComponent('all_customers')]
class AllCustomersComponent
{
    private int $id;

    public function __construct(private CustomersRepository $customersRepository)
    {}

    public function getAllCustomer() : Array
    {
         $data = $this->customersRepository->findAll();;
        // $pagination = $paginator->paginate(
        //     $data,
        //     $request->query->getInt('page', 1), /* page number */
        //     8
        // );
        return $this->customersRepository->findAll();
    }
}