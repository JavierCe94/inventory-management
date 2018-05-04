<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 27/04/18
 * Time: 11:59
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\UpdateGarmentTypes;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Service\FindGarmentTypeIfExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
use PHPUnit\Framework\TestCase;

class UpdateGarmentTypesTest extends TestCase
{
    /**
     * @test
     */
    public function given_new_data_when_table_entry_exists_then_update()
    {
        $id = 2;
        $name = 'poncho';
        $garmentTypeEntity = $this
            ->getMockBuilder(GarmentType::class)
            ->disableOriginalConstructor()->getMock();
        $garmentTypeEntity->method('getId')->willReturn($id);
        $garmentTypeEntity->method('getName')->willReturn($name);

        $garmentTypeRepository = $this
            ->getMockBuilder(GarmentTypeRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentTypeRepository->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentTypeEntity);
        $garmentTypeRepository->method('updateGarmentType')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true));


        $findGarmentTypeIfExist = new FindGarmentTypeIfExists($garmentTypeRepository);

        $updateGarmentTypeTransform = new UpdateGarmentTypeTransform();
        $updateGarmentType = new UpdateGarmentType(
            $garmentTypeRepository,
            $updateGarmentTypeTransform,
            $findGarmentTypeIfExist
        );
        $updateGarmentTypeCommand = new UpdateGarmentTypeCommand($id, $name);
        $output = $updateGarmentType->handle($updateGarmentTypeCommand);

        $this->assertEquals('GarmentType actualizado con exito', $output);
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_does_not_exists_then_success()
    {
        $id = 2;
        $name = 'poncho';

        $garmentTypeRepository = $this
            ->getMockBuilder(GarmentTypeRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentTypeRepository->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $garmentTypeRepository->method('updateGarmentType')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true));
//            ->willReturn($garmentTypeEntity);


        $findGarmentTypeIfExist = new FindGarmentTypeIfExists($garmentTypeRepository);
        $updateGarmentTypeTransform = new UpdateGarmentTypeTransform();

        $updateGarmentType = new UpdateGarmentType(
            $garmentTypeRepository,
            $updateGarmentTypeTransform,
            $findGarmentTypeIfExist
        );
        $output = $updateGarmentType->handle(new UpdateGarmentTypeCommand($id, $name));

        $this->assertEquals('El tipo de prenda no existe', $output);
    }
}