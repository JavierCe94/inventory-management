<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ChangeStatusToAcceptedRequest\ChangeStatusToAcceptedRequest;
use Inventory\Management\Application\RequestEmployee\ChangeStatusToAcceptedRequest\ChangeStatusToAcceptedRequestCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeStatusToAcceptedRequestController extends RoleAdmin
{
    public function __invoke(Request $request, ChangeStatusToAcceptedRequest $changeStatusToAcceptedRequest): Response
    {
        return new JsonResponse(
            $changeStatusToAcceptedRequest->handle(
                new ChangeStatusToAcceptedRequestCommand(
                    $request->attributes->get('id')
                )
            ),
            Response::HTTP_OK
        );
    }
}
