<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 26/04/2018
 * Time: 12:54
 */

namespace Inventory\Management\Application\GarmentSize\Size\ListAllSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

class ListAllSize
{
    private $sizeRepository;
    private $listAllSizeTransform;

    /**
     * ListAllSize constructor.
     * @param $sizeRepository
     * @param $listAllSizeTransform
     */
    public function __construct(
        SizeRepositoryInterface $sizeRepository,
        ListAllSizeTransformInterface $listAllSizeTransform
    ) {
        $this->sizeRepository = $sizeRepository;
        $this->listAllSizeTransform = $listAllSizeTransform;
    }

    public function handle(ListAllSizeCommand $listAllSizeCommand): array
    {
        $allSize = $this->sizeRepository->findAllSize();
        $allSize = $this->listAllSizeTransform->transform($allSize);

        return [
            "data" => $allSize,
            "code" => HttpResponses::OK
            ];
    }
}
