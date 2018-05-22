<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 22/05/18
 * Time: 12:09
 */

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