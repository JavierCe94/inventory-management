<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class GarmentTypeNameExistsException extends \Exception
{
    public function __construct()
    {
        $message = "El tipo de prenda ya existe";
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
