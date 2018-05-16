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
    const OK = 'Garment actualizado con exito';
    const CODE_OK = 200;

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
     * @return array
     */
    public function handle(UpdateGarmentCommand $updateGarmentCommand): array
    {
        $output = ['data' => self::OK, 'code' => self::CODE_OK ];

        $garmentId = $updateGarmentCommand->getId();
        $garmentName = $updateGarmentCommand->getName();

        try {
            $garmentEntity = $this->findGarmentIfExists->execute($garmentId);
        } catch (GarmentNotExistsException $gnex) {
            return [
                'data' => $gnex->getMessage(),
                'code' => $gnex->getCode()
            ];
        }

        $this
            ->garmentRepository
            ->updateGarment(
                $garmentEntity,
                $garmentName
            );

        return $output;
    }
}
