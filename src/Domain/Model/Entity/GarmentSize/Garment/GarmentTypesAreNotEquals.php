<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class GarmentTypesAreNotEquals extends \Exception
{
    public function __construct()
    {
        $message = "Los tipos de prenda no son iguales";
        $code = HttpResponses::BAD_REQUEST;
        parent::__construct($message, $code);
    }
}
