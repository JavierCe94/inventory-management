<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 22/05/18
 * Time: 14:58
 */

namespace Inventory\Management\Application\GarmentSize\UpdateGarmentSize;


use Assert\Assertion;

class UpdateGarmentSizeCommand
{
    private $idGarment;
    private $idSize;
    private $sizeValue;
    private $stock;

    /**
     * CreateGarmentSizeTableCommand constructor.
     * @param $idGarment
     * @param $idSize
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

    /**
     * @return mixed
     */
    public function getIdGarment()
    {
        return $this->idGarment;
    }

    /**
     * @return mixed
     */
    public function getIdSize()
    {
        return $this->idSize;
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
    public function getStock()
    {
        return $this->stock;
    }
}