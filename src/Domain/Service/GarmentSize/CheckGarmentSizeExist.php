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
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class CheckGarmentSizeExist implements Observer
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
       ;

        $output =  $this->garmentSizeRepository->findByGarmentAndSizeId($size, $garment);
        if (null !== $output) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }

        return $output;
    }

    public function update()
    {
        // TODO: Implement update() method.
    }
}