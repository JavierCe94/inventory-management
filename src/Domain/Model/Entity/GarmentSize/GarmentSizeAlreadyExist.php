<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 10:04
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;


use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Throwable;

class GarmentSizeAlreadyExist extends \Exception
{
    public function __construct()
    {
        $message = "GarmentSize Already Exist";
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($message, $code);
    }
}