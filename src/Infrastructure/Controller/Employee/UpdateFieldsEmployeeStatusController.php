<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\UpdateFieldsEmployeeStatus\UpdateFieldsEmployeeStatus;
use Inventory\Management\Application\Employee\UpdateFieldsEmployeeStatus\UpdateFieldsEmployeeStatusCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateFieldsEmployeeStatusController extends RoleAdmin
{
    public function UpdateFieldsEmployeeStatus(
        Request $request,
        UpdateFieldsEmployeeStatus $updateFieldsEmployeeStatus
    ): Response {
        $updateFieldsEmployeeStatusCommand = new UpdateFieldsEmployeeStatusCommand(
            $request->attributes->get('nif'),
            $request->query->get('image'),
            $request->query->get('expirationcontractdate'),
            $request->query->get('possiblerenewal'),
            $request->query->get('availableholidays'),
            $request->query->get('holidayspendingtoapplyfor'),
            $request->query->get('department'),
            $request->query->get('subdepartment')
        );

        return new JsonResponse(
            $updateFieldsEmployeeStatus->handle($updateFieldsEmployeeStatusCommand),
            Response::HTTP_OK
        );
    }
}
