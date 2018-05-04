<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 02/05/2018
 * Time: 12:11
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Size;


use Throwable;

class SizeDoNotExist extends \Exception
{
    public function __construct()
    {
        $message = 'Esta talla no existe ya';
        parent::__construct($message);
    }
}
