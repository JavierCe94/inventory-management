<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 10:04
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize;


use Throwable;

class GarmentSizeAlreadyExist extends \Exception
{
    public function __construct()
    {
        $message = "";
        $code = 400;
        parent::__construct($message, $code);
    }

}