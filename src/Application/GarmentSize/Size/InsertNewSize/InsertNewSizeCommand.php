<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 14:56
 */

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;


use Assert\Assertion;

class InsertNewSizeCommand
{
    private $sizeValue;
    private $garmentTypeId;

    /**
     * InsertNewSizeCommand constructor.
     * @param int $sizeValue
     * @param int $garmentType
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(int $sizeValue, int $garmentTypeId)
    {
        Assertion::numeric($sizeValue, "El valor no es un integer valido");
        Assertion::numeric($garmentTypeId, 'No es un valor Valido');
        $this->sizeValue = $sizeValue;
        $this->garmentTypeId = $garmentTypeId;
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
        return $this->garmentTypeId;
    }



}
