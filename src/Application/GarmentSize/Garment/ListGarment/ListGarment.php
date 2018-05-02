<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/04/18
 * Time: 19:12
 */

namespace Inventory\Management\Application\GarmentSize\Garment\ListGarment;


use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;

class ListGarment
{
    private $garmentRepository;
    private $listGarmentTransform;

    public function __construct(
        GarmentRepositoryInterface $garmentRepository,
        ListGarmentTransformInterface $listGarmentTransform
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->listGarmentTransform = $listGarmentTransform;
    }

    public function handle(): array
    {
        $garments = $this->garmentRepository->listGarment();
        return $this->listGarmentTransform->transform($garments);
    }
}