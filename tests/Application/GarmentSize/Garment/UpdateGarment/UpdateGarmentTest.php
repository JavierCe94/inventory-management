<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\UpdateGarment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarment;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentCommand;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateGarmentTest extends TestCase
{
    /**
     * @var UpdateGarment
     */
    private $handler;
    /**
     * @var MockObject
     */
    private $garmentRepositoryStub;
    private $garmentTypeRepositoryStub;

    public function setUp()
    {
        $this->garmentRepositoryStub = $this->createMock(GarmentRepository::class);
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepository::class);
        $this->handler = new UpdateGarment(
            $this->garmentRepositoryStub,
            new FindGarmentIfExists($this->garmentRepositoryStub),
            new UpdateGarmentTransform()
        );
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_exists_then_update()
    {
        $id = 2;
        $name = 'poncho floreado';
        $garmentEntity = $this->createMock(Garment::class);
        $garmentEntity->method('getId')->willReturn($id);
        $garmentEntity->method('getName')->willReturn($name);
        $this->garmentRepositoryStub->method('findGarmentById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentEntity);
        $this->garmentRepositoryStub->expects($this->once())
            ->method('updateGarment');
        $this->handler->handle(new UpdateGarmentCommand($id, $name));
        $this->assertTrue(true, true);
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_does_not_exists_then_show_message()
    {
        $id = 2;
        $name = 'poncho floreado';
        $this->garmentRepositoryStub->method('findGarmentById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $this->expectException(GarmentNotExistsException::class);
        $this->handler->handle(new UpdateGarmentCommand($id, $name));
    }
}