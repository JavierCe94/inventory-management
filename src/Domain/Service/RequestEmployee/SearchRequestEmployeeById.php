<?php

namespace Inventory\Management\Domain\Service\RequestEmployee;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\NotFoundRequestsEmployeeException;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployee;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById as SearchRequestEmployeeByIdI;

class SearchRequestEmployeeById implements SearchRequestEmployeeByIdI
{
    private $requestEmployeeRepository;

    public function __construct(RequestEmployeeRepository $requestEmployeeRepository)
    {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
    }

    /**
     * @throws NotFoundRequestsEmployeeException
     */
    public function execute(int $id): RequestEmployee
    {
        $requestEmployee = $this->requestEmployeeRepository->findRequestEmployeeById($id);
        if (null === $requestEmployee) {
            throw new NotFoundRequestsEmployeeException();
        }

        return $requestEmployee;
    }
}
