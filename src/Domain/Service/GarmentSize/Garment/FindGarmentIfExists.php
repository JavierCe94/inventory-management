<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 3/05/18
 * Time: 12:39
 */

namespace Inventory\Management\Domain\Service\GarmentSize\Garment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Service\Util\Observer\ListExceptions;
use Inventory\Management\Domain\Service\Util\Observer\Observer;

class FindGarmentIfExists implements Observer
{
    private $garmentRepository;
    private $stateException;

    public function __construct(GarmentRepositoryInterface $garmentRepository)
    {
        $this->garmentRepository = $garmentRepository;
        $this->stateException = false;
    }

    /**
     * @param int $id
     *
     * @return Garment|null
     */
    public function execute(int $id): ?Garment
    {
        $output = $this->garmentRepository->findGarmentById($id);
        if (null === $output) {
            $this->stateException = true;
            ListExceptions::instance()->notify();
        }
        return $output;
    }

    /**
     * @throws GarmentNotExistsException
     */
    public function update()
    {
        if ($this->stateException) {
            throw new GarmentNotExistsException();
        }
    }
}
