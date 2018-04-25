<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 15:45
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Assert\Assertion;

class InsertGarmentCommand
{
    private $name;
    private $garmentTypeId;

    public function __construct($name, $garmentTypeId)
    {
        Assertion::notBlank($name);
        Assertion::string($name);
        Assertion::notBlank($garmentTypeId);
        Assertion::numeric($garmentTypeId);

        $this->name = $name;
        $this->garmentTypeId = $garmentTypeId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getGarmentTypeId(): int
    {
        return $this->garmentTypeId;
    }
}