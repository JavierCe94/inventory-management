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
    public function __invoke(Request $request, CreateEmployee $createEmployee): Response
    {
        $createEmployeeCommand = new CreateEmployeeCommand(
            $request->files->get('image'),
            $request->request->get('nif'),
            $request->request->get('password'),
            $request->request->get('name'),
            $request->request->get('inssnumber'),
            $request->request->get('telephone'),
            $request->request->get('codeemployee'),
            $request->request->get('firstcontractdate'),
            $request->request->get('senioritydate'),
            $request->request->get('subdepartment')
        );

        return new JsonResponse(
            $createEmployee->handle($createEmployeeCommand),
            Response::HTTP_CREATED
        );
    }
}
