<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 25/04/2018
 * Time: 14:56
 */

namespace Inventory\Management\Application\GarmentSize\Size\InsertNewSize;


use Assert\Assertion;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;

class InsertNewSizeCommand
{
    private $sizeValue;
    private $garmentType;

    /**
     * InsertNewSizeCommand constructor.
     * @param int $sizeValue
     * @param int $garmentType
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(int $sizeValue, int $garmentType)
    {
        Assertion::integer($sizeValue, "El valor no es un integer valido");
        Assertion::integer($garmentType, 'No es un string Valido');
        $this->sizeValue = $sizeValue;
        $this->garmentType = $garmentType;
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
    public function getGarmentType()
    {
        return $this->garmentType;
    }



}
