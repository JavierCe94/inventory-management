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
    public function __invoke(Request $request, CreateSubDepartment $createSubDepartment): Response
    {
        return new JsonResponse(
            $createSubDepartment->handle(
                new CreateSubDepartmentCommand(
                    $request->attributes->get('department'),
                    $request->request->get('name')
                )
            ),
            Response::HTTP_CREATED
        );
    }
}
