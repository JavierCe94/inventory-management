<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\InsertGarmentType;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentTypeNameExists;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class InsertGarmentTypeTest extends TestCase
{
    /**
     * @var InsertGarmentType
     */
    private $handler;
    /**
     * @var MockObject
     */
    private $garmentTypeRepositoryStub;

    public function setUp()
    {
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepository::class);
        $this->handler = new InsertGarmentType(
            $this->garmentTypeRepositoryStub,
            new GarmentTypeNameExists($this->garmentTypeRepositoryStub),
            new InsertGarmentTypeTransform()
        );
    }

    /**
     * @test
     */
    public function given_a_valid_garmentType_when_it_does_not_exist_then_insert()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $this->garmentTypeRepositoryStub->method('insertGarmentType')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));
        $this->garmentTypeRepositoryStub->expects($this->once())
            ->method('insertGarmentType');
        $this->handler->handle(new InsertGarmentTypeCommand('zapatillas'));
        $this->assertTrue(true, true);
    }

    /**
     * @test
     */
    public function given_a_valid_garmentType_when_it_exists_then_catch_excepction()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));
        $this->expectException(GarmentTypeNameExistsException::class);
        $this->handler->handle(new InsertGarmentTypeCommand('poncho'));
    }
}
