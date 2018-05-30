<?php

namespace Inventory\Management\Application\Employee\ShowDataEmployee;

use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;

class ShowDataEmployee
{
    private $showDataEmployeeTransform;
    private $searchEmployeeByNif;

    public function __construct(
        ShowDataEmployeeTransformI $showDataEmployeeTransform,
        SearchEmployeeByNif $searchEmployeeByNif
    ) {
        $this->showDataEmployeeTransform = $showDataEmployeeTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
    }

    /**
     * @return array
     * @throws \Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException
     */
    public function handle(ShowDataEmployeeCommand $showDataEmployeeCommand)
    {
        return $this->showDataEmployeeTransform->transform(
            $this->searchEmployeeByNif->execute(
                $showDataEmployeeCommand->dataToken()->nif
            )
        );
    }
}
