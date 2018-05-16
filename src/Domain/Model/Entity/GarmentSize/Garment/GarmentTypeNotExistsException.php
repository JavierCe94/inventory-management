<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 26/04/2018
 * Time: 9:53
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Throwable;

class GarmentTypeNotExistsException extends \Exception
{
    public function __construct()
    {
        $message = "El tipo de prenda no existe";
        $code = 404;
        parent::__construct($message, $code);
    }
}
