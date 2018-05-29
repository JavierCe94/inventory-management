<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Assert\Assertion;

class InsertGarmentCommand
{
    private $name;
    private $garmentTypeId;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(string $name, int $garmentTypeId)
    {
        Assertion::notBlank($name);
        Assertion::string($name);
        Assertion::notBlank($garmentTypeId);
        Assertion::numeric($garmentTypeId);
        $this->name = $name;
        $this->garmentTypeId = $garmentTypeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGarmentTypeId(): int
    {
        return $this->garmentTypeId;
    }
}
