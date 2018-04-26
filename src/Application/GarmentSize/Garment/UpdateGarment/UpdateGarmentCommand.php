<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 13:15
 */

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

use Assert\Assertion;

class UpdateGarmentCommand
{
    private $name;
    private $id;

    /**
     * UpdateGarmentCommand constructor.
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
        Assertion::notBlank($name, 'Tienes que especificar un nombre de prenda');
        Assertion::string($name, 'El nombre de la prenda tiene que ser una palabra');

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