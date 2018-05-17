<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 15:29
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Size;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class FindSizeEntityIfExists implements Observer
{
    private $stateException;
    private $sizeRepository;

    /**
     * FindSizeEntityIfExists constructor.
     * @param $sizeRepository
     */
    public function __construct(SizeRepositoryInterface $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
        $this->stateException = false ;
    }

    /**
     * @param int $id
     * @param int $sizeValue
     * @return array
     * @throws SizeDoNotExist
     */
    public function execute(int $id, int $sizeValue): ?Size
    {
        $output = $this->sizeRepository->findSizeBySizeValueAndGarmentType($sizeValue, $id);
        if (null === $output) {
            $this->stateException = true;
            ListExceptions::instance()->notify();

        }
        return $output;
    }

    /**
     * @throws SizeDoNotExist
     */
    public function update()
    {
        if ($this->stateException) {
            throw new SizeDoNotExist();
        }
    }
}