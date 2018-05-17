<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 11:49
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;


class FindGarmentTypeIfExists implements Observer
{
    private $stateException;
    private $garmentTypeRepository;

    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->stateException = false ;
    }


    public function execute(int $id): ?GarmentType
    {
        $output = $this->garmentTypeRepository->findGarmentTypeById($id);
        if (is_null($output)) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }
        return $output;
    }

    /**
     * @throws GarmentTypeNotExistsException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new GarmentTypeNotExistsException();
        }
    }
}
