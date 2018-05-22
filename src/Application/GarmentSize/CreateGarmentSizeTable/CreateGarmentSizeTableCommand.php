<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 9:52
 */

namespace Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable;




use Assert\Assertion;

class CreateGarmentSizeTableCommand
{

    private $idGarment;
    private $idSize;
    private $sizeValue;

    /**
     * CreateGarmentSizeTableCommand constructor.
     * @param $idGarment
     * @param $idSize
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
}