<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\ShowEmployeeByNif\ShowEmployeeByNif;
use Inventory\Management\Application\Employee\ShowEmployeeByNif\ShowEmployeeByNifCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowEmployeeByNifController extends RoleAdmin
{
    public function __invoke(Request $request, ShowEmployeeByNif $showEmployeeByNif): Response
    {
        return new JsonResponse(
            $showEmployeeByNif->handle(
                new ShowEmployeeByNifCommand(
                    $request->attributes->get('nif')
                )
            ),
            Response::HTTP_OK
        );
    }
}
