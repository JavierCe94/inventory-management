<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 22/05/18
 * Time: 13:17
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;


use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypesAreNotEquals;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class CheckGarmentTypeAreEquals implements Observer
{
    private $stateException;

    /**
     * CheckGarmentTypeAreEquals constructor.
     * @param bool $stateException
     */
    public function __construct()
    {
        $this->stateException = false;
    }


    public function execute(GarmentType $garmentType1, GarmentType $garmentType2)
    {
        if ($garmentType1 !== $garmentType2) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }
    }

    /**
     * @throws GarmentTypesAreNotEquals
     */
    public function update()
    {
        if ($this->stateException) {
            throw new GarmentTypesAreNotEquals();
        }
    }
}