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
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
use PHPUnit\Framework\TestCase;

class UpdateGarmentTypesTest extends TestCase
{
    /**
     * Test hecho, pero no le veo mucho sentido, ya que no se devuelve nada.
     *
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
//            ->willReturn($garmentTypeEntity);

        $updateGarmentTypeTransform = new UpdateGarmentTypeTransform();
        $updateGarmentType = new UpdateGarmentType($garmentTypeRepository, $updateGarmentTypeTransform);
        $updateGarmentType->handle(new UpdateGarmentTypeCommand(2, $name));

        $this->assertTrue(true);
    }

    /**
     * Test para comprobar que tira la excepción cuando findGarmentTypeById no devuelve nada
     *
     * @test
     */
    public function given_new_data_when_table_entry_does_not_exists_then_throw_Exception()
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

        $updateGarmentTypeTransform = new UpdateGarmentTypeTransform();

        $updateGarmentType = new UpdateGarmentType($garmentTypeRepository, $updateGarmentTypeTransform);
        $this->expectException(GarmentTypeNotExistsException::class);
        $updateGarmentType->handle(new UpdateGarmentTypeCommand($id, $name));
    }
}