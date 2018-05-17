<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 11:18
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class GarmentNameExists implements Observer
{
    private $garmentRepository;
    private $stateException;
    public function __construct(GarmentRepositoryInterface $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
        $this->stateException = false;
    }

    /**
     * @param string $name
     */
    public function check(string $name)
    {
        $output = $this->garmentRepository->findGarmentByName($name);
        if (null !== $output) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }
    }

    /**
     * @throws GarmentNameExistsException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new GarmentNameExistsException();
        }
    }
}