<?php

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class GarmentSizeAlreadyExist extends \Exception
{
    public function __construct()
    {
        $message = "GarmentSize Already Exist";
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}
