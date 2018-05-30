<?php

namespace Inventory\Management\Infrastructure\Controller\Department;

use Inventory\Management\Application\Department\showDepartments\ShowDepartments;
use Inventory\Management\Infrastructure\Util\Role\RoleAdmin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowDepartmentsController extends RoleAdmin
{
    public function showDepartments(ShowDepartments $showDepartments): Response
    {
        return new JsonResponse(
            $showDepartments->handle(),
            Response::HTTP_OK
        );
    }
}
