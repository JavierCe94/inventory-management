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
    public function __invoke(
        Request $request,
        ChangeStatusToDisableEmployee $changeStatusToDisableEmployee
    ): Response {
        return new JsonResponse(
            $changeStatusToDisableEmployee->handle(
                new ChangeStatusToDisableEmployeeCommand(
                    $request->attributes->get('nif')
                )
            ),
            Response::HTTP_OK
        );
    }
}
