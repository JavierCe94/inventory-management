<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 25/04/18
 * Time: 15:45
 */

namespace Inventory\Management\Application\GarmentSize\Garment\InsertGarment;

use Assert\Assertion;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;

class InsertGarmentCommand
{
    private $name;
    private $garmentTypeId;

    public function __construct(string $name, GarmentType $garmentTypeId)
    {
        Assertion::notBlank($name);
        Assertion::string($name);
        Assertion::isInstanceOf($garmentTypeId, GarmentType::class);
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
     * @return GarmentType
     */
    public function getGarmentTypeId(): GarmentType
    {
        return $this->garmentTypeId;
    }
}