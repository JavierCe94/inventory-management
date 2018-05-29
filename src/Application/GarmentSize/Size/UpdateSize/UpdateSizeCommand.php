<?php

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Assert\Assertion;

class UpdateSizeCommand
{
    private $sizeValue;
    private $newSizeValue;
    private $GarmentTypeId;

    /**
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
    
    public function getNewSizeValue()
    {
        return $this->newSizeValue;
    }
    
    public function getSizeValue()
    {
        return $this->sizeValue;
    }
    
    public function getGarmentTypeId()
    {
        return $this->GarmentTypeId;
    }
}
