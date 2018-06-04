<?php

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

use Assert\Assertion;

class UpdateGarmentCommand
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
        Assertion::notBlank($name, 'Tienes que especificar un nombre de prenda');
        Assertion::string($name, 'El nombre de la prenda tiene que ser una palabra');
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
