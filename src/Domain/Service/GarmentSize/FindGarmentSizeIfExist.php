<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 16/05/18
 * Time: 9:15
 */

namespace Inventory\Management\Domain\Service\GarmentSize;

use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class FindGarmentSizeIfExist implements Observer
{
    private $garmentSizeRepository;
    private $stateException;
    /**
     * CheckGarmentSizeExist constructor.
     * @param $garmentSizeRepository
     */
    public function __construct(GarmentSizeRepositoryInterface $garmentSizeRepository)
    {
        $this->garmentSizeRepository = $garmentSizeRepository;
        $this->stateException = false ;
    }

    public function __invoke($size, $garment): ?GarmentSize
    {


        $output =  $this->garmentSizeRepository->findByGarmentAndSizeId($size, $garment);

        if (null === $output) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $output;
    }

    /**
     * @throws GarmentSizeNotExist
     */
    public function update()
    {
        if ($this->stateException) {
            throw new GarmentSizeNotExist();
        }
    }
}