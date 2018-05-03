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
        $message = "No existe ese tipo de prenda";
        parent::__construct($message);
    }
}
