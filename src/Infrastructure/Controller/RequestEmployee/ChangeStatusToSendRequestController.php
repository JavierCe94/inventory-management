<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ChangeStatusToSendRequest\ChangeStatusToSendRequest;
use Inventory\Management\Application\RequestEmployee\ChangeStatusToSendRequest\ChangeStatusToSendRequestCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusToSendRequestController extends RoleEmployee
{
    public function __invoke(Request $request, ChangeStatusToSendRequest $changeStatusToSendRequest): Response
    {
        return new JsonResponse(
            $changeStatusToSendRequest->handle(
                new ChangeStatusToSendRequestCommand(
                    $this->dataToken()->nif,
                    $request->attributes->get('id')
                )
            ),
            Response::HTTP_OK
        );
    }
}
