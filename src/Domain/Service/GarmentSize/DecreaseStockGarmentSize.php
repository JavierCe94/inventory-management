<?php

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\NotFoundStockGarmentSizeException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\DecreaseStockGarmentSize as DecreaseStockGarmentSizeI;

class DecreaseStockGarmentSize implements DecreaseStockGarmentSizeI
{
    private $garmentSizeRepository;

    public function __construct(GarmentSizeRepository $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
    }

    /**
     * @throws NotFoundStockGarmentSizeException
     */
    public function execute(GarmentSize $garmentSize, int $countGarmentSize): void
    {
        if ($countGarmentSize > $garmentSize->getStock()) {
            throw new NotFoundStockGarmentSizeException();
        }
        $newStock = $garmentSize->getStock() - $countGarmentSize;
        $this->garmentSizeRepository->updateStockGarmentSize($garmentSize, $newStock);
    }
}
