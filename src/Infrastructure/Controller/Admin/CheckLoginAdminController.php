<?php

namespace Inventory\Management\Infrastructure\Controller\Admin;

use Inventory\Management\Application\Admin\CheckLoginAdmin\CheckLoginAdminCommand;
use Inventory\Management\Infrastructure\Util\CommandBus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdminController
{
    public function __invoke(Request $request, CommandBus $commandBus): Response
    {
        return new JsonResponse(
            $commandBus->handle(
                new CheckLoginAdminCommand(
                    $request->request->get('username'),
                    $request->request->get('password')
                )
            ),
            Response::HTTP_OK
        );
    }
}
