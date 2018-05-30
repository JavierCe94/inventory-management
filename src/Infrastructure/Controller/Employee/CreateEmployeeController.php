<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\CreateEmployee\CreateEmployee;
use Inventory\Management\Application\Employee\CreateEmployee\CreateEmployeeCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateEmployeeController extends RoleAdmin
{
    public function createEmployee(Request $request, CreateEmployee $createEmployee): Response
    {
        $createEmployeeCommand = new CreateEmployeeCommand(
            $request->query->get('image'),
            $request->query->get('nif'),
            $request->query->get('password'),
            $request->query->get('name'),
            $request->query->get('inssnumber'),
            $request->query->get('telephone'),
            $request->query->get('codeemployee'),
            $request->query->get('firstcontractdate'),
            $request->query->get('senioritydate'),
            $request->query->get('subdepartment')
        );

        return new JsonResponse(
            $createEmployee->handle($createEmployeeCommand),
            Response::HTTP_CREATED
        );
    }
}
