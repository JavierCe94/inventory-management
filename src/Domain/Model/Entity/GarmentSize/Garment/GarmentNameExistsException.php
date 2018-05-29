<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class GarmentNameExistsException extends \Exception
{
    public function __construct()
    {
        $message = 'Nombre prenda ya existe';
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
