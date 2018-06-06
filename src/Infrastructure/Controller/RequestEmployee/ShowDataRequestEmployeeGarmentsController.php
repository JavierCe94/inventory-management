<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments\ShowRequestEmployeeGarments;
use Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments\ShowRequestEmployeeGarmentsCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowDataRequestEmployeeGarmentsController extends RoleEmployee
{
    public function __invoke(
        Request $request,
        ShowRequestEmployeeGarments $showRequestEmployeeGarments
    ): Response {
        return new JsonResponse(
            $showRequestEmployeeGarments->handle(
                new ShowRequestEmployeeGarmentsCommand(
                    $this->dataToken()->nif,
                    $request->request->get('requestemployee'),
                    $request->request->get('isdeleted')
                )
            ),
            Response::HTTP_OK
        );
    }
}
