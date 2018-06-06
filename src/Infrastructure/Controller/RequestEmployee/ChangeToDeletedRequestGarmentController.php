<?php

namespace Inventory\Management\Infrastructure\Controller\RequestEmployee;

use Inventory\Management\Application\RequestEmployee\ChangeToDeletedRequestGarment\ChangeToDeletedRequestGarment;
use Inventory\Management\Application\RequestEmployee\ChangeToDeletedRequestGarment\ChangeToDeletedRequestGarmentCommand;
use Inventory\Management\Infrastructure\Util\Role\RoleEmployee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeToDeletedRequestGarmentController extends RoleEmployee
{
    public function __invoke(
        Request $request,
        ChangeToDeletedRequestGarment $changeToDeletedRequestGarment
    ): Response {
        return new JsonResponse(
            $changeToDeletedRequestGarment->handle(
                new ChangeToDeletedRequestGarmentCommand(
                    $this->dataToken()->nif,
                    $request->attributes->get('requestgarment')
                )
            ),
            Response::HTTP_OK
        );
    }
}
