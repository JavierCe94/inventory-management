<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class GarmentTypeNotExistsException extends \Exception
{
    public function __construct()
    {
        $message = "El tipo de prenda no existe";
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
