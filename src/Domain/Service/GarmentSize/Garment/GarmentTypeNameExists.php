<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 10:04
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class GarmentTypeNameExists implements Observer
{
    private $garmentTypeRepository;
    private $stateException;

    public function __construct(
        GarmentTypeRepositoryInterface $garmentTypeRepository
    ) {
        $this->garmentTypeRepository = $garmentTypeRepository;
        $this->stateException = false ;
    }

    public function check(string $name)
    {
        $output = $this->garmentTypeRepository->findGarmentTypeByName($name);
        if (null !== $output) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }
    }

    /**
     * @throws GarmentTypeNameExistsException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new GarmentTypeNameExistsException();
        }
    }
}