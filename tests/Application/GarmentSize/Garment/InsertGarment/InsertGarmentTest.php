<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarment;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentCommand;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNameExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;
use Inventory\Management\Domain\Service\GarmentSize\Garment\GarmentNameExists;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class InsertGarmentTest extends TestCase
{
    /**
     * @var InsertGarment
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
        $this->handler = new InsertGarment(
            $this->garmentRepositoryStub,
            $this->garmentTypeRepositoryStub,
            new InsertGarmentTransform(),
            new GarmentNameExists($this->garmentRepositoryStub),
            new FindGarmentTypeIfExists($this->garmentTypeRepositoryStub)
        );
    }

    /**
     * @test
     */
    public function given_a_valid_garment_when_it_does_not_exist_then_insert()
    {
        $this->garmentRepositoryStub->method('findGarmentByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $this->garmentRepositoryStub->expects($this->once())
            ->method('insertGarment');
        $this->garmentRepositoryStub->method('insertGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($this->createMock(Garment::class));
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));
        $this->handler->handle(new InsertGarmentCommand('zapatillas', 3));
        $this->assertTrue(true, true);
    }

    /**
     * @test
     */
    public function given_a_valid_garment_when_it_exists_then_catch_Garment_Name_Exists_Exception()
    {
        $this->garmentRepositoryStub->method('findGarmentByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(Garment::class));
        $this->garmentRepositoryStub->method('insertGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($this->createMock(Garment::class));
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));
        $this->expectException(GarmentNameExistsException::class);
        $this->handler->handle(new InsertGarmentCommand('zapatillas', 3));
    }

    /**
     * @test
     */
    public function given_a_valid_garment_when_garmentType_does_not_exist_then_catch_GarmentTypeNotExistsException()
    {
        $this->garmentRepositoryStub->method('findGarmentByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $this->garmentRepositoryStub->method('insertGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($this->createMock(Garment::class));
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $this->expectException(GarmentTypeNotExistsException::class);
        $this->handler->handle(new InsertGarmentCommand('name', 3));
    }
}