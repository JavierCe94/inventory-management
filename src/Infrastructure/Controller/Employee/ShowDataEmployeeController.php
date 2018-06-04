<?php

namespace Inventory\Management\Infrastructure\Controller\Employee;

use Inventory\Management\Application\Employee\ShowEmployeeByNif\ShowEmployeeByNif;
use Inventory\Management\Application\Employee\ShowEmployeeByNif\ShowEmployeeByNifCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowDataEmployeeController extends RoleEmployee
{
    public function __invoke(ShowEmployeeByNif $showEmployeeByNif): Response
    {
        return new JsonResponse(
            $showEmployeeByNif->handle(
                new ShowEmployeeByNifCommand(
                    $this->dataToken()->nif
                )
            ),
            Response::HTTP_OK
        );
    }
}
