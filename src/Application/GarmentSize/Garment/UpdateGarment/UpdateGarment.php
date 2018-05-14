<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 26/04/18
 * Time: 13:15
 */

namespace Inventory\Management\Application\GarmentSize\Garment\UpdateGarment;

use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;

class UpdateGarment
{
    private $garmentRepository;
    private $updateGarmentTransform;
    private $findGarmentIfExists;

    /**
     * UpdateGarment constructor.
     *
     * @param GarmentRepositoryInterface      $garmentRepository
     * @param UpdateGarmentTransformInterface $updateGarmentTransform
     * @param FindGarmentIfExists             $findGarmentIfExists
     */
    public function __construct(
        GarmentRepositoryInterface $garmentRepository,
        UpdateGarmentTransformInterface $updateGarmentTransform,
        FindGarmentIfExists $findGarmentIfExists
    ) {
        $this->garmentRepository = $garmentRepository;
        $this->updateGarmentTransform = $updateGarmentTransform;
        $this->findGarmentIfExists = $findGarmentIfExists;
    }

    /**
     * @param UpdateGarmentCommand $updateGarmentCommand
     *
     * @return string
     */
    public function handle(UpdateGarmentCommand $updateGarmentCommand)
    {
        $output = 'Garment actualizado con exito';

        // Cacheo parametros
        $garmentId = $updateGarmentCommand->getId();
        $garmentName = $updateGarmentCommand->getName();

        try {
            $garmentEntity = $this->findGarmentIfExists->execute($garmentId);
        } catch (GarmentNotExistsException $gnex) {
            // Si lanza excepcion, se devuelve el mensaje al controlador
            return $gnex->getMessage();
        }

        // Actualizacion de prenda
        $this
            ->garmentRepository
            ->updateGarment(
                $garmentEntity,
                $garmentName
            );

        return $output;
    }
}
