<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class NotFoundStockGarmentSizeException extends \Exception
{
    public function __construct()
    {
        $message = 'No hay suficiente stock';
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
