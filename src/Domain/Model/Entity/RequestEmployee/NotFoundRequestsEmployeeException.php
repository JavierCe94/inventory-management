<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class NotFoundRequestsEmployeeException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna solicitud';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
