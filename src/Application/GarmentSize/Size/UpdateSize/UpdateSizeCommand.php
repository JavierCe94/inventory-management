<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 14:19
 */

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Assert\Assertion;

class UpdateSizeCommand
{
    private $sizeValue;
    private $newSizeValue;
    private $GarmentTypeId;

    /**
     * UpdateSizeCommand constructor.
     * @param $sizeValue
     * @param $GarmentTypeId
     * @param $newSizeValue
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($sizeValue, $GarmentTypeId, $newSizeValue)
    {
        Assertion::numeric($sizeValue);
        Assertion::numeric($newSizeValue);
        Assertion::numeric($GarmentTypeId);
        $this->sizeValue = $sizeValue;
        $this->newSizeValue = $newSizeValue;
        $this->GarmentTypeId = $GarmentTypeId;
    }

    /**
     * @return mixed
     */
    public function getNewSizeValue()
    {
        return $this->newSizeValue;
    }

    /**
     * @return mixed
     */
    public function getSizeValue()
    {
        return $this->sizeValue;
    }

    /**
     * @return mixed
     */
    public function getGarmentTypeId()
    {
        return $this->GarmentTypeId;
    }

}
