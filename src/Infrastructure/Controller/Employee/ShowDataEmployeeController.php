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
        $showEmployeeByNifCommand = new ShowEmployeeByNifCommand(
            $this->dataToken()->nif
        );

        return new JsonResponse(
            $showEmployeeByNif->handle($showEmployeeByNifCommand),
            Response::HTTP_OK
        );
    }
}
