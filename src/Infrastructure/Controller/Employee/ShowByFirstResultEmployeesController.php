<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\ShowByFirstResultEmployees\ShowByFirstResultEmployees;
use Inventory\Management\Application\Employee\ShowByFirstResultEmployees\ShowByFirstResultEmployeesCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowByFirstResultEmployeesController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        ShowByFirstResultEmployees $showByFirstResultEmployees
    ): Response {
        $showByFirstResultEmployeesCommand = new ShowByFirstResultEmployeesCommand(
            $request->attributes->get('firstresultposition'),
            $request->request->get('name'),
            $request->request->get('code'),
            $request->request->get('department'),
            $request->request->get('subdepartment')
        );

        return new JsonResponse(
            $showByFirstResultEmployees->handle($showByFirstResultEmployeesCommand),
            Response::HTTP_OK
        );
    }
}
