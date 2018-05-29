<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class GarmentNotExistsException extends \Exception
{
    public function __construct()
    {
        $message = 'La prenda que quiere editar no existe';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
