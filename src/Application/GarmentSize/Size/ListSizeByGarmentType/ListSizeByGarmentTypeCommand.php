<?php

namespace Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType;

use Assert\Assertion;

class ListSizeByGarmentTypeCommand
{
    private $garmentTypeId;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(int $garmentTypeId)
    {
        Assertion::numeric($garmentTypeId);
        $this->garmentTypeId = $garmentTypeId;
    }
    
    public function getGarmentTypeId(): int
    {
        return $this->garmentTypeId;
    }
}
