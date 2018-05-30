<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\ShowDataEmployee\ShowDataEmployee;
use Inventory\Management\Application\Employee\ShowDataEmployee\ShowDataEmployeeCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowDataEmployeeController extends RoleEmployee
{
    public function showDataEmployee(ShowDataEmployee $showDataEmployee): Response
    {
        $showDataEmployeeCommand = new ShowDataEmployeeCommand(
            $this->dataToken()
        );

        return new JsonResponse(
            $showDataEmployee->handle($showDataEmployeeCommand),
            Response::HTTP_OK
        );
    }
}
