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
    public function __invoke(
        Request $request,
        UpdateFieldsEmployeeStatus $updateFieldsEmployeeStatus
    ): Response {
        $updateFieldsEmployeeStatusCommand = new UpdateFieldsEmployeeStatusCommand(
            $request->attributes->get('nif'),
            $request->request->get('image'),
            $request->request->get('expirationcontractdate'),
            $request->request->get('possiblerenewal'),
            $request->request->get('availableholidays'),
            $request->request->get('holidayspendingtoapplyfor'),
            $request->request->get('department'),
            $request->request->get('subdepartment')
        );

        return new JsonResponse(
            $updateFieldsEmployeeStatus->handle($updateFieldsEmployeeStatusCommand),
            Response::HTTP_OK
        );
    }
}
