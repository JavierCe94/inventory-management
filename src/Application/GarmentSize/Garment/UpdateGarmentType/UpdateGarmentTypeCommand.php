<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 12:27
 */

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType;

use Assert\Assertion;

class UpdateGarmentTypeCommand
{
    private $name;
    private $id;

    /**
     * UpdateGarmentTypeCommand constructor.
     *
     * @param int    $id
     * @param string $name
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(int $id, string $name)
    {
        Assertion::notBlank($id, 'El id no puede estar en blanco');
        Assertion::numeric($id, 'El id tiene que ser un numero');
        Assertion::notBlank($name, 'Tienes que especificar un nombre al tipo de prenda');
        Assertion::string($name, 'El nombre del tipo tiene que ser un id');

        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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