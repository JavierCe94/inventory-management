<?php

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;

use Assert\Assertion;

class InsertNewSizeCommand
{
    private $sizeValue;
    private $garmentTypeId;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(int $sizeValue, int $garmentTypeId)
    {
        Assertion::numeric($sizeValue, "El valor no es un integer valido");
        Assertion::numeric($garmentTypeId, 'No es un valor Valido');
        $this->sizeValue = $sizeValue;
        $this->garmentTypeId = $garmentTypeId;
    }
    
    public function getSizeValue()
    {
        return $this->sizeValue;
    }
    
    public function getGarmentTypeId()
    {
        return $this->garmentTypeId;
    }
}
