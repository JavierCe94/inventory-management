<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments;

use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeGarmentRepository;

class ShowRequestEmployeeGarments
{
    private $requestEmployeeGarmentRepository;
    private $showRequestEmployeeGarmentsTransform;

    public function __construct(
        RequestEmployeeGarmentRepository $requestEmployeeGarmentRepository,
        ShowRequestEmployeeGarmentsTransformI $showRequestEmployeeGarmentsTransform
    ) {
        $this->requestEmployeeGarmentRepository = $requestEmployeeGarmentRepository;
        $this->showRequestEmployeeGarmentsTransform = $showRequestEmployeeGarmentsTransform;
    }

    public function handle(ShowRequestEmployeeGarmentsCommand $showRequestEmployeeGarmentsCommand): array
    {
        return $this->showRequestEmployeeGarmentsTransform->transform(
            $this->requestEmployeeGarmentRepository->showRequestEmployeeGarments(
                $showRequestEmployeeGarmentsCommand->nifEmployee(),
                $showRequestEmployeeGarmentsCommand->idRequestEmployee(),
                $showRequestEmployeeGarmentsCommand->isDeleted()
            )
        );
    }
}
