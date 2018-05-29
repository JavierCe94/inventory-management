<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class GarmentSizeNotExist extends \Exception
{
    public function __construct()
    {
        $message = "GarmentSize Do Not Exist";
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($message, $code);
    }
}
