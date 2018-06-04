<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType;

use Assert\Assertion;

class UpdateGarmentTypeCommand
{
    private $name;
    private $id;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($id, $name)
    {
        Assertion::notBlank($id, 'El id no puede estar en blanco');
        Assertion::numeric($id, 'El id tiene que ser un numero');
        Assertion::notBlank($name, 'Tienes que especificar un nombre al tipo de prenda');
        Assertion::string($name, 'El nombre del tipo tiene que ser un id');
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
