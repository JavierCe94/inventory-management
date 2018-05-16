<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 10:03
 */

namespace Inventory\Management\Domain\Service\GarmentSize;


use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;

class CheckGarmentSizeExist
{
    private $garmentSizeRepository;

    /**
     * CheckGarmentSizeExist constructor.
     * @param $garmentSizeRepository
     */
    public function __construct(GarmentSizeRepositoryInterface $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
    }

    public function __invoke($size, $garment): ?GarmentSize
    {
        return $this->garmentSizeRepository->findByGarmentAndSizeId($size, $garment);
    }
}