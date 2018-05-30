<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee\UpdateBasicFieldsEmployee;
use Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee\UpdateBasicFieldsEmployeeCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateBasicFieldsEmployeeController extends RoleEmployee
{
    public function updateBasicFieldsEmployee(
        Request $request,
        UpdateBasicFieldsEmployee $updateBasicFieldsEmployee
    ): Response {
        $updateBasicFieldsEmployeeCommand = new UpdateBasicFieldsEmployeeCommand(
            $this->dataToken(),
            $request->query->get('name'),
            $request->query->get('password'),
            $request->query->get('telephone')
        );

        return new JsonResponse(
            $updateBasicFieldsEmployee->handle($updateBasicFieldsEmployeeCommand),
            Response::HTTP_OK
        );
    }
}
