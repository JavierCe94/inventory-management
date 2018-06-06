<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments\ShowRequestEmployeeGarments;
use Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments\ShowRequestEmployeeGarmentsCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowRequestEmployeeGarmentsController extends RoleAdmin
{
    public function __invoke(
        Request $request,
        ShowRequestEmployeeGarments $showRequestEmployeeGarments
    ): Response {
        return new JsonResponse(
            $showRequestEmployeeGarments->handle(
                new ShowRequestEmployeeGarmentsCommand(
                    $request->request->get('employee'),
                    $request->request->get('requestemployee'),
                    $request->request->get('isdeleted')
                )
            ),
            Response::HTTP_OK
        );
    }
}
