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
    public function __invoke(
        Request $request,
        UpdateBasicFieldsEmployee $updateBasicFieldsEmployee
    ): Response {
        return new JsonResponse(
            $updateBasicFieldsEmployee->handle(
                new UpdateBasicFieldsEmployeeCommand(
                    $this->dataToken(),
                    $request->request->get('name'),
                    $request->request->get('password'),
                    $request->request->get('telephone')
                )
            ),
            Response::HTTP_OK
        );
    }
}
