<?php

namespace Inventory\Management\Application\GarmentSize\UpdateGarmentSize;

use Assert\Assertion;

class UpdateGarmentSizeCommand
{
    private $idGarment;
    private $idSize;
    private $sizeValue;
    private $stock;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($idGarment, $idSize, $sizeValue, $stock)
    {
        Assertion::numeric($idGarment);
        Assertion::numeric($idSize);
        Assertion::numeric($stock);
        $this->idGarment = $idGarment;
        $this->idSize = $idSize;
        $this->sizeValue = $sizeValue;
        $this->stock = $stock;
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
    
    public function getStock()
    {
        return $this->stock;
    }
}
