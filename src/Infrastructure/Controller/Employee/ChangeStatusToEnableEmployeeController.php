<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\ChangeStatusToEnableEmployee\ChangeStatusToEnableEmployee;
use Inventory\Management\Application\Employee\ChangeStatusToEnableEmployee\ChangeStatusToEnableEmployeeCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusToEnableEmployeeController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        ChangeStatusToEnableEmployee $changeStatusToEnableEmployee
    ): Response {
        $changeStatusToEnableEmployeeCommand = new ChangeStatusToEnableEmployeeCommand(
            $request->attributes->get('nif')
        );

        return new JsonResponse(
            $changeStatusToEnableEmployee->handle($changeStatusToEnableEmployeeCommand),
            Response::HTTP_OK
        );
    }
}
