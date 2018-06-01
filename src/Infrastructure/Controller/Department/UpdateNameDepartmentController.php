<?php

namespace Inventory\Management\Infrastructure\Controller\Department;

use Inventory\Management\Application\Department\UpdateNameDepartment\UpdateNameDepartment;
use Inventory\Management\Application\Department\UpdateNameDepartment\UpdateNameDepartmentCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateNameDepartmentController extends RoleAdmin
{
    public function __invoke(Request $request, UpdateNameDepartment $updateNameDepartment): Response
    {
        $updateNameDepartmentCommand = new UpdateNameDepartmentCommand(
            $request->attributes->get('department'),
            $request->request->get('name')
        );

        return new JsonResponse(
            $updateNameDepartment->handle($updateNameDepartmentCommand),
            Response::HTTP_OK
        );
    }
}
