<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 13:04
 */

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;


use Assert\Assertion;

class ListSizeByGarmentTypeCommand
{
    private $garmentTypeId;

    /**
     * ListSizeByGarmentTypeCommand constructor.
     * @param int $garmentTypeId
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(int $garmentTypeId)
    {
        Assertion::numeric($garmentTypeId);
        $this->garmentTypeId = $garmentTypeId;
    }

    /**
     * @return int
     */
    public function getGarmentTypeId(): int
    {
        return $this->garmentTypeId;
    }
}
