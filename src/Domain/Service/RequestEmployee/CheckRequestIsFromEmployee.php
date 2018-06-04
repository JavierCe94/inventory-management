<?php

namespace Inventory\Management\Domain\Service\RequestEmployee;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\NotFoundRequestsEmployeeException;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestIsFromEmployee as CheckRequestIsFromEmployeeI;

class CheckRequestIsFromEmployee implements CheckRequestIsFromEmployeeI
{
    private $requestEmployeeRepository;

    public function __construct(RequestEmployeeRepository $requestEmployeeRepository)
    {
        $this->requestEmployeeRepository = $requestEmployeeRepository;
    }

    /**
     * @throws NotFoundRequestsEmployeeException
     */
    public function execute(string $nifEmployee, int $idRequestEmployee): void
    {
        $requestEmployee = $this->requestEmployeeRepository->checkRequestIsFromEmployee(
            $nifEmployee,
            $idRequestEmployee
        );
        if (null === $requestEmployee) {
            throw new NotFoundRequestsEmployeeException();
        }
    }
}
