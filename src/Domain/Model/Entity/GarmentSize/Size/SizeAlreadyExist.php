<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class SizeAlreadyExist extends \Exception
{
    public function __construct()
    {
        $message = 'Esta talla ya existe';
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
