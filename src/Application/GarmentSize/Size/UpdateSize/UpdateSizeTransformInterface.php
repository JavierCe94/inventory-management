<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 27/04/2018
 * Time: 14:19
 */

namespace Inventory\Management\Application\GarmentSize\Size\UpdateSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;

interface UpdateSizeTransformInterface
{
    public function transform(Size $sizes): array;
}
