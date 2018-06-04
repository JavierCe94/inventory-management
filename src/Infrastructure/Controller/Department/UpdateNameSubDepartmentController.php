<?php

namespace Inventory\Management\Infrastructure\Controller\Department;

use Inventory\Management\Application\Department\UpdateNameSubDepartment\UpdateNameSubDepartment;
use Inventory\Management\Application\Department\UpdateNameSubDepartment\UpdateNameSubDepartmentCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateNameSubDepartmentController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        UpdateNameSubDepartment $updateNameSubDepartment
    ): Response {
        return new JsonResponse(
            $updateNameSubDepartment->handle(
                new UpdateNameSubDepartmentCommand(
                    $request->attributes->get('subdepartment'),
                    $request->request->get('name')
                )
            ),
            Response::HTTP_OK
        );
    }
}
