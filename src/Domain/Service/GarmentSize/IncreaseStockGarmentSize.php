<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\IncreaseStockGarmentSize as IncreaseStockGarmentSizeI;

class IncreaseStockGarmentSize implements IncreaseStockGarmentSizeI
{
    private $garmentSizeRepository;

    public function __construct(GarmentSizeRepository $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
    }

    public function execute(GarmentSize $garmentSize, int $countGarmentSize): void
    {
        $newStock = $garmentSize->getStock() + $countGarmentSize;
        $this->garmentSizeRepository->updateStockGarmentSize($garmentSize, $newStock);
    }
}
