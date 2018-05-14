<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 11:19
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;

class GarmentNameExistsException extends \Exception
{
    public function __construct()
    {
        $message = 'Nombre prenda ya existe';
        parent::__construct($message);
    }
}