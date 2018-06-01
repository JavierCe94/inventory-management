<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\CheckLoginEmployee\CheckLoginEmployee;
use Inventory\Management\Application\Employee\CheckLoginEmployee\CheckLoginEmployeeCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginEmployeeController
{
    public function __invoke(Request $request, CheckLoginEmployee $checkLoginEmployee): Response
    {
        $checkLoginEmployeeCommand = new CheckLoginEmployeeCommand(
            $request->request->get('nif'),
            $request->request->get('password')
        );

        return new JsonResponse(
            $checkLoginEmployee->handle($checkLoginEmployeeCommand),
            Response::HTTP_OK
        );
    }
}
