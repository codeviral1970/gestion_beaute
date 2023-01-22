<?php 

namespace App\Components;

use App\Repository\CustomersRepository;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent('customer_search')]
class SearchCustomerComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private CustomersRepository $customersRepository)
    {}

    public function getSearch(): array
    {
        return $this->customersRepository->findByQuery($this->query);
    }
}