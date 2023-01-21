<?php

namespace App\Components;

use App\Entity\Customers;
use App\Repository\CustomersRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;


#[AsTwigComponent('customer')]
class CustomerComponent
{
    public int $id;

    public function __construct(private CustomersRepository $customersRepository)
    {}

    public function getCustomers() : Customers
    {
        return $this->customersRepository->find($this->id);
    }
}