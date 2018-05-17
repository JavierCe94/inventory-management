<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 9:15
 */

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class FindAllGarmentSize implements Observer
{
    private $garmentSizeRepository;
    private $stateException;
    /**
     * FindSizeEntityIfExists constructor.
     * @param $sizeRepository
     */
    public function __construct(GarmentSizeRepositoryInterface $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->stateException = false;
    }

    /**
     * @param int $id
     * @param int $sizeValue
     * @return array
     * @throws SizeDoNotExist
     */
    public function execute(): array
    {
        $output = $this->garmentSizeRepository->findAllGarmentSize();

        return $output;
    }
    public function update()
    {
        // TODO: Implement update() method.
    }
}