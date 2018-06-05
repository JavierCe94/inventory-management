<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\NotFoundStockGarmentSizeException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\CheckStockGarmentSize as CheckStockGarmentSizeI;

class CheckStockGarmentSize implements CheckStockGarmentSizeI
{
    /**
     * @throws NotFoundStockGarmentSizeException
     */
    public function execute(GarmentSize $garmentSize, int $garmentSizeCount): void
    {
        if ($garmentSizeCount > $garmentSize->getStock()) {
            throw new NotFoundStockGarmentSizeException();
        }
    }
}
