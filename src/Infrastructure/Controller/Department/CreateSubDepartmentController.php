<?php

namespace Inventory\Management\Infrastructure\Controller\Department;

use Inventory\Management\Application\Department\CreateSubDepartment\CreateSubDepartment;
use Inventory\Management\Application\Department\CreateSubDepartment\CreateSubDepartmentCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateSubDepartmentController extends RoleAdmin
{
    public function createSubDepartment(Request $request, CreateSubDepartment $createSubDepartment): Response
    {
        $createSubDepartmentCommand = new CreateSubDepartmentCommand(
            $request->attributes->get('department'),
            $request->query->get('name')
        );

        return new JsonResponse(
            $createSubDepartment->handle($createSubDepartmentCommand),
            Response::HTTP_CREATED
        );
    }
}
