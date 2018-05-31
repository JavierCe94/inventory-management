<?php

namespace Inventory\Management\Domain\Service\GarmentSize\Size;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryI;

class FindSizeEntityIfExists implements FindSizeEntityIfExistsI
{
    private $sizeRepository;

    public function __construct(SizeRepositoryI $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    /**
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
