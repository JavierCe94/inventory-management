<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments;

use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\SearchRequestEmployeeById;

class ShowRequestEmployeeGarments
{
    private $requestEmployeeGarmentRepository;
    private $showRequestEmployeeGarmentsTransform;
    private $searchEmployeeByNif;
    private $searchRequestEmployeeById;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        ShowRequestEmployeeGarmentsTransformI $showRequestEmployeeGarmentsTransform,
        SearchEmployeeByNif $searchEmployeeByNif,
        SearchRequestEmployeeById $searchRequestEmployeeById
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->showRequestEmployeeGarmentsTransform = $showRequestEmployeeGarmentsTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
        $this->searchRequestEmployeeById = $searchRequestEmployeeById;
    }

    public function handle(ShowRequestEmployeeGarmentsCommand $showRequestEmployeeGarmentsCommand): array
    {
        $this->searchEmployeeByNif->execute(
            $showRequestEmployeeGarmentsCommand->nifEmployee()
        );
        $this->searchRequestEmployeeById->execute(
            $showRequestEmployeeGarmentsCommand->idRequestEmployee()
        );

        return $this->showRequestEmployeeGarmentsTransform->transform(
            $this->requestEmployeeGarmentRepository->showRequestEmployeeGarments(
                $showRequestEmployeeGarmentsCommand->nifEmployee(),
                $showRequestEmployeeGarmentsCommand->idRequestEmployee(),
                $showRequestEmployeeGarmentsCommand->isDeleted()
            )
        );
    }
}
