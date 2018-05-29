<?php

namespace Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable;

use Assert\Assertion;

class CreateGarmentSizeTableCommand
{
    private $idGarment;
    private $idSize;
    private $sizeValue;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($idGarment, $idSize, $sizeValue)
    {
        Assertion::numeric($idGarment);
        Assertion::numeric($idSize);
        $this->idGarment = $idGarment;
        $this->idSize = $idSize;
        $this->sizeValue = $sizeValue;
    }
    
    public function getIdGarment()
    {
        return $this->idGarment;
    }
    
    public function getIdSize()
    {
        return $this->idSize;
    }
    
    public function getSizeValue()
    {
        return $this->sizeValue;
    }
}
