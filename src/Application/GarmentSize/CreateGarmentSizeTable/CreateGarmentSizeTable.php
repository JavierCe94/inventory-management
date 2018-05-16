<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 9:41
 */

namespace Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable;


use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\CheckGarmentSizeExist;
use Inventory\Management\Domain\Service\GarmentSize\FindAllGarmentSize;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;

class CreateGarmentSizeTable
{
    private $garmentTypeRepository;
    private $findAllGarmentSize;
    private $findGarmentTypeIfExist;
    private $findSizeEntityIfExist;
    private $checkGarmentSizeExist;

    /**
     * CreateGarmentSizeTable constructor.
     * @param $garmentTypeRepository
     * @param $findAllGarmentSize
     * @param $findGarmentTypeIfExist
     * @param $findSizeEntityIfExist
     * @param $checkGarmentSizeExist
     */
    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository,
        FindAllGarmentSize $findAllGarmentSize,
        FindGarmentTypeIfExists $findGarmentTypeIfExist,
        FindSizeEntityIfExists $findSizeEntityIfExist,
        CheckGarmentSizeExist $checkGarmentSizeExist
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->findAllGarmentSize = $findAllGarmentSize;
        $this->findGarmentTypeIfExist = $findGarmentTypeIfExist;
        $this->findSizeEntityIfExist = $findSizeEntityIfExist;
        $this->checkGarmentSizeExist = $checkGarmentSizeExist;
    }

    public function handle(CreateGarmentSizeTableCommand $createGarmentSizeTableCommand)
    {
        ;
    }
}