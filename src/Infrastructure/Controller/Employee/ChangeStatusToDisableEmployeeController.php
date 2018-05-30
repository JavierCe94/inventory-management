<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\ChangeStatusToDisableEmployee\ChangeStatusToDisableEmployee;
use Inventory\Management\Application\Employee\ChangeStatusToDisableEmployee\ChangeStatusToDisableEmployeeCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusToDisableEmployeeController extends RoleAdmin
{
    public function changeStatusToDisableEmployee(
        Request $request,
        ChangeStatusToDisableEmployee $changeStatusToDisableEmployee
    ): Response {
        $changeStatusToDisableEmployeeCommand = new ChangeStatusToDisableEmployeeCommand(
            $request->attributes->get('nif')
        );

        return new JsonResponse(
            $changeStatusToDisableEmployee->handle($changeStatusToDisableEmployeeCommand),
            Response::HTTP_OK
        );
    }
}
