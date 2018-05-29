<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class SizeDoNotExist extends \Exception
{
    public function __construct()
    {
        $message = 'Esta talla no existe';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
