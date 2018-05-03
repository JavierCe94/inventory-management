<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 10:15
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

class GarmentTypeNameExistsException extends \Exception
{
    public function __construct()
    {
        $message = 'El tipo de prenda ya existe';
        parent::__construct($message);
    }
}