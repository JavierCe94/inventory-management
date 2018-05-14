<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 11:27
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType;

use Assert\Assertion;

class InsertGarmentTypeCommand
{
    private $name;

    /**
     * InsertGarmentTypeCommand constructor.
     *
     * @param string $name
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(string $name)
    {
        Assertion::notBlank($name, 'Tienes que especificar un nombre al tipo de prenda');

        $this->name = $name;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}