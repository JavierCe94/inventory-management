<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\UpdateGarmentTypes;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarmentType\UpdateGarmentTypeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateGarmentTypesTest extends TestCase
{
    /**
     * @var UpdateGarmentType
     */
    private $handler;
    /**
     * @var MockObject
     */
    private $garmentTypeRepositoryStub;

    public function setUp()
    {
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepository::class);
        $this->handler = new UpdateGarmentType(
            $this->garmentTypeRepositoryStub,
            new UpdateGarmentTypeTransform(),
            new FindGarmentTypeIfExists($this->garmentTypeRepositoryStub)
        );
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_exists_then_update()
    {
        $id = 2;
        $name = 'poncho';
        $garmentTypeEntity = $this->createMock(GarmentType::class);
        $garmentTypeEntity->method('getId')->willReturn($id);
        $garmentTypeEntity->method('getName')->willReturn($name);
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentTypeEntity);
        $this->garmentTypeRepositoryStub->expects($this->once())->method('updateGarmentType');
        $updateGarmentTypeCommand = new UpdateGarmentTypeCommand($id, $name);
        $this->handler->handle($updateGarmentTypeCommand);
        $this->assertTrue(true, true);
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_does_not_exists_then_success()
    {
        $id = 2;
        $name = 'poncho';
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $this->expectException(GarmentTypeNotExistsException::class);
        $this->handler->handle(new UpdateGarmentTypeCommand($id, $name));
    }
}