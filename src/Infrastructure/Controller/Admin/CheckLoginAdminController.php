<?php

namespace Inventory\Management\Infrastructure\Controller\Admin;

use Inventory\Management\Application\Admin\CheckLoginAdmin\CheckLoginAdmin;
use Inventory\Management\Application\Admin\CheckLoginAdmin\CheckLoginAdminCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdminController
{
    public function __invoke(Request $request, CheckLoginAdmin $checkLoginAdmin): Response
    {
        return new JsonResponse(
            $checkLoginAdmin->handle(
                new CheckLoginAdminCommand(
                    $request->request->get('username'),
                    $request->request->get('password')
                )
            ),
            Response::HTTP_OK
        );
    }
}
