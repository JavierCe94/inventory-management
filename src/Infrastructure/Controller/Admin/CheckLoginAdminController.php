<?php

namespace Inventory\Management\Infrastructure\Controller\Admin;

use Inventory\Management\Application\Admin\CheckLoginAdmin\CheckLoginAdminCommand;
use Inventory\Management\Infrastructure\Util\CommandBus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdminController
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function checkLoginAdmin(Request $request): Response
    {
        $checkLoginAdminCommand = new CheckLoginAdminCommand(
            $request->query->get('username'),
            $request->query->get('password')
        );

        return new JsonResponse(
            $this->commandBus->handle($checkLoginAdminCommand),
            Response::HTTP_OK
        );
    }
}
