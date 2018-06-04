<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest\ChangeStatusToDeletedRequest;
use Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest\ChangeStatusToDeletedRequestCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusToDeletedRequestController extends RoleEmployee
{
    public function __invoke(Request $request, ChangeStatusToDeletedRequest $changeStatusToDeletedRequest): Response
    {
        return new JsonResponse(
            $changeStatusToDeletedRequest->handle(
                new ChangeStatusToDeletedRequestCommand(
                    $this->dataToken()->nif,
                    $request->attributes->get('id')
                )
            ),
            Response::HTTP_OK
        );
    }
}
