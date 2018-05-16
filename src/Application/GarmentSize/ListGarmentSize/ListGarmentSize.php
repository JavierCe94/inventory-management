<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 15/05/18
 * Time: 12:32
 */

namespace Inventory\Management\Application\GarmentSize\ListGarmentSize;


use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;

class ListGarmentSize
{
    private $garmentSizeRepository;
    private $listGarmentSizeTransform;

    /**
     * ListAllSize constructor.
     * @param $sizeRepository
     * @param $listAllSizeTransform
     */
    public function __construct(
        GarmentSizeRepositoryInterface $garmentSizeRepository,
        ListGarmentSizeTransformInterface $listGarmentSizeTransform
    ) {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->listGarmentSizeTransform = $listGarmentSizeTransform;
    }

    public function handle(ListGarmentSizeCommand $listGarmentSizeCommand): array
    {
        $list = $this->garmentSizeRepository->findAllGarmentSize();
        dump($list);
        $list = $this->listGarmentSizeTransform->transform($list);

        return $list;
    }
}