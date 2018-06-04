<?php

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Assert\Assertion;

class InsertGarmentTypeCommand
{
    private $name;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($name)
    {
        Assertion::notBlank($name, 'Tienes que especificar un nombre al tipo de prenda');
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
