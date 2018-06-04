<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\CreateRequestEmployee\CreateRequestEmployee;
use Inventory\Management\Application\RequestEmployee\CreateRequestEmployee\CreateRequestEmployeeCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateRequestEmployeeController extends RoleEmployee
{
    public function __invoke(CreateRequestEmployee $createRequestEmployee): Response
    {
        return new JsonResponse(
            $createRequestEmployee->handle(
                new CreateRequestEmployeeCommand(
                    $this->dataToken()->nif
                )
            ),
            Response::HTTP_OK
        );
    }
}
