<?php

namespace Inventory\Management\Domain\Service\RequestEmployee;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\NotFoundRequestEmployeeGarmentsException;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarment;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\CheckRequestGarmentIsFromEmployee
    as CheckRequestGarmentIsFromEmployeeI;

class CheckRequestGarmentIsFromEmployee implements CheckRequestGarmentIsFromEmployeeI
{
    private $requestEmployeeGarmentRepository;

    public function __construct(RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository)
    {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
    }

    /**
     * @throws NotFoundRequestEmployeeGarmentsException
     */
    public function execute(string $nifEmployee, int $idRequestGarment): RequestEmployeeGarment
    {
        $requestEmployeeGarment = $this->requestEmployeeGarmentRepository->checkRequestGarmentIsFromEmployee(
            $nifEmployee,
            $idRequestGarment
        );
        if (null === $requestEmployeeGarment) {
            throw new NotFoundRequestEmployeeGarmentsException();
        }

        return $requestEmployeeGarment;
    }
}
