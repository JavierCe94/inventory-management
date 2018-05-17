<?php
/**
 * Created by PhpStorm.
 * User: Fran Moraton
 * Date: 03/05/2018
 * Time: 12:59
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class FindGarmentTypeIfExists implements Observer
{
    private $garmentTypeRepository;
    private $stateException;

    public function __construct(GarmentTypeRepositoryInterface $garmentTypeRepository)
    {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->stateException = false;
    }

    /**
     * @param int $id
     *
     * @return GarmentType|null
     */
    public function execute(int $id): ?GarmentType
    {
        $output = $this->garmentTypeRepository->findGarmentTypeById($id);
        if (null === $output) {
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
