<?php

namespace Inventory\Management\Infrastructure\Controller\Department;

use Inventory\Management\Application\Department\CreateDepartment\CreateDepartment;
use Inventory\Management\Application\Department\CreateDepartment\CreateDepartmentCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateDepartmentController extends RoleAdmin
{
    public function __invoke(Request $request, CreateDepartment $createDepartment): Response
    {
        return new JsonResponse(
            $createDepartment->handle(
                new CreateDepartmentCommand(
                    $request->request->get('name')
                )
            ),
            Response::HTTP_CREATED
        );
    }
}
