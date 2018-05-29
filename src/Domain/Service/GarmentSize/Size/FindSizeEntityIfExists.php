<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Size;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;

class FindSizeEntityIfExists
{
    private $sizeRepository;

    public function __construct(SizeRepositoryInterface $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    /**
     * @param int $id
     * @param int $sizeValue
     * @return Size|null
     * @throws SizeDoNotExist
     */
    public function execute(int $id, int $sizeValue): ?Size
    {
        $output = $this->sizeRepository->findSizeBySizeValueAndGarmentType($sizeValue, $id);
        if (null === $output) {
            throw new SizeDoNotExist();
        }

        return $output;
    }
}
