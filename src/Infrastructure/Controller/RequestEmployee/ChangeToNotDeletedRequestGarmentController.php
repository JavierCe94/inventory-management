<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ChangeToNotDeletedRequestGarment\ChangeToNotDeletedRequestGarment;
use Inventory\Management\Application\RequestEmployee\ChangeToNotDeletedRequestGarment\
    ChangeToNotDeletedRequestGarmentCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeToNotDeletedRequestGarmentController extends RoleEmployee
{
    public function __invoke(
        Request $request,
        ChangeToNotDeletedRequestGarment $changeToNotDeletedRequestGarment
    ): Response {
        return new JsonResponse(
            $changeToNotDeletedRequestGarment->handle(
                new ChangeToNotDeletedRequestGarmentCommand(
                    $this->dataToken()->nif,
                    $request->attributes->get('requestgarment')
                )
            ),
            Response::HTTP_OK
        );
    }
}
