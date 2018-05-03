<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 13:29
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

use Throwable;

class GarmentTypeNotExistsException extends \Exception
{
    public function __construct()
    {
        $message = 'El tipo de prenda no existe';
        parent::__construct($message);
    }
}