<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ChangeStatusToDeniedRequest\ChangeStatusToDeniedRequest;
use Inventory\Management\Application\RequestEmployee\ChangeStatusToDeniedRequest\ChangeStatusToDeniedRequestCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusToDeniedRequestController extends RoleAdmin
{
    public function __invoke(Request $request, ChangeStatusToDeniedRequest $changeStatusToDeniedRequest): Response
    {
        return new JsonResponse(
            $changeStatusToDeniedRequest->handle(
                new ChangeStatusToDeniedRequestCommand(
                    $request->attributes->get('id')
                )
            ),
            Response::HTTP_OK
        );
    }
}
