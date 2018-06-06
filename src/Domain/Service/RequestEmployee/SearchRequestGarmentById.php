<?php

namespace Inventory\Management\Domain\Service\RequestEmployee;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\NotFoundRequestEmployeeGarmentsException;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarment;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestGarmentById as SearchRequestGarmentByIdI;

class SearchRequestGarmentById implements SearchRequestGarmentByIdI
{
    private $requestEmployeeGarmentRepository;

    public function __construct(RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository)
    {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
    }

    /**
     * @throws NotFoundRequestEmployeeGarmentsException
     */
    public function execute(int $id): RequestEmployeeGarment
    {
        $requestGarment = $this->requestEmployeeGarmentRepository->findRequestEmployeeGarmentById($id);
        if (null === $requestGarment) {
            throw new NotFoundRequestEmployeeGarmentsException();
        }

        return $requestGarment;
    }
}
