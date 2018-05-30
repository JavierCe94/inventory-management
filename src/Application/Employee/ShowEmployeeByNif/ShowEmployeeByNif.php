<?php

namespace Inventory\Management\Application\Employee\ShowEmployeeByNif;

use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;

class ShowEmployeeByNif
{
    private $showEmployeeByNifTransform;
    private $searchEmployeeByNif;

    public function __construct(
        ShowEmployeeByNifTransformI $showEmployeeByNifTransform,
        SearchEmployeeByNif $searchEmployeeByNif
    ) {
        $this->showEmployeeByNifTransform = $showEmployeeByNifTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
    }

    /**
     * @param ShowEmployeeByNifCommand $showEmployeeByNifCommand
     * @return array
     * @throws \Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException
     */
    public function handle(ShowEmployeeByNifCommand $showEmployeeByNifCommand)
    {
        return $this->showEmployeeByNifTransform->transform(
            $this->searchEmployeeByNif->execute(
                $showEmployeeByNifCommand->nif()
            )
        );
    }
}
