<?php

namespace Inventory\Management\Application\Employee\ShowEmployeeByNif;

use Inventory\Management\Domain\Model\Entity\Employee\SearchEmployeeByNif;

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

    public function handle(ShowEmployeeByNifCommand $showEmployeeByNifCommand)
    {
        return $this->showEmployeeByNifTransform->transform(
            $this->searchEmployeeByNif->execute(
                $showEmployeeByNifCommand->nif()
            )
        );
    }
}
