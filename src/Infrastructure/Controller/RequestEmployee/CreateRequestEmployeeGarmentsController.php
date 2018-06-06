<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\CreateRequestEmployeeGarments\CreateRequestEmployeeGarments;
use Inventory\Management\Application\RequestEmployee\CreateRequestEmployeeGarments\CreateRequestEmployeeGarmentsCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateRequestEmployeeGarmentsController
{
    public function __invoke(Request $request, CreateRequestEmployeeGarments $createRequestEmployeeGarments)
    {
        return new JsonResponse(
            $createRequestEmployeeGarments->handle(
                new CreateRequestEmployeeGarmentsCommand(
                    $request->request->get('employee'),
                    $request->request->get('requestemployee'),
                    $request->request->get('garment'),
                    $request->request->get('size'),
                    $request->request->get('count')
                )
            ),
            Response::HTTP_CREATED
        );
    }
}
