<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee\ShowRequestsEmployee;
use Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee\ShowRequestsEmployeeCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdminEmployee;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowDataRequestsEmployeeController extends RoleEmployee
{
    public function __invoke(Request $request, ShowRequestsEmployee $showRequestsEmployee): Response
    {
        return new JsonResponse(
            $showRequestsEmployee->handle(
                new ShowRequestsEmployeeCommand(
                    $this->dataToken()->nif,
                    $request->request->get('status')
                )
            ),
            Response::HTTP_OK
        );
    }
}
