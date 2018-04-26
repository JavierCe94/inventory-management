<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/04/18
 * Time: 19:12
 */

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;


use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;

class ListGarment
{
    private $garmentRepository;
    private $garmentTypeRepository;
    private $listGarmentTransform;

    public function __construct(
        GarmentRepositoryInterface $garmentRepository,
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        ListGarmentTransformInterface $listGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->listGarmentTransform = $listGarmentTransform;
    }

    public function handle(): array
    {
        $garments = $this->garmentRepository->listGarment();
        return $this->listGarmentTransform->transform($garments);
    }
}