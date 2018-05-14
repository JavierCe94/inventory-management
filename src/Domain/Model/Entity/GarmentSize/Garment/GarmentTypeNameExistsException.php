<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 13:08
 */

namespace Inventory\Management\Domain\Model\Entity\GarmentSize\Garment;


class GarmentTypeNameExistsException extends \Exception
{
    public function __construct()
    {
        $message = "KO";
        $code = 500;
        parent::__construct($message, $code);
    }
}
