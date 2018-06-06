<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class NotFoundRequestEmployeeGarmentsException extends \Exception
{
    public function __construct()
    {
        $message = 'No se ha encontrado ninguna solicitud de prenda';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
