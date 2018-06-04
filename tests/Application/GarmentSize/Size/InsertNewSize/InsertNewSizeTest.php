<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSize;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeCommand;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeAlreadyExist;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\CheckIfSizeExist;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Size\SizeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InsertNewSizeTest extends TestCase
{
    /**
     * @var InsertNewSize
     */
    private $handler;
    /**
     * @var MockObject
     */
    private $sizeRepositoryStub;
    /**
     * @var MockObject
     */
    private $garmentTypeRepositoryStub;

    public function setUp()
    {
        $this->sizeRepositoryStub = $this->createMock(SizeRepository::class);
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepository::class);
        $this->handler = new InsertNewSize(
            $this->sizeRepositoryStub,
            new FindGarmentTypeIfExists($this->garmentTypeRepositoryStub),
            new CheckIfSizeExist($this->sizeRepositoryStub),
            new InsertNewSizeTransform()
        );
    }

    /**
     * @test
     */
    public function given_a_valid_sizevalue_and_garmenttype_when_they_are_not_already_created_then_insert_into_size_table()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->with(2)
            ->willReturn($this->createMock(GarmentType::class));
        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(2, 2)
            ->willReturn(null);
        $size = new Size($this->createMock(GarmentType::class), 2);
        $this->sizeRepositoryStub->method('addSize')
            ->with($size)
            ->willReturn($size);
        $this->sizeRepositoryStub->expects($this->once())
            ->method('addSize');
        $this->handler->handle(new InsertNewSizeCommand(2, 2));
        $this->assertTrue(true, true);
    }

    /**
     * @test
     */
    public function given_a_valid_garmenttype_and_valid_sizevalue_when_already_created_then_expect_exception()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->with(2)
            ->willReturn($this->createMock(GarmentType::class));
        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(2, 2)
            ->willReturn($this->createMock(Size::class));
        $this->expectException(SizeAlreadyExist::class);
        $this->handler->handle(new InsertNewSizeCommand(2, 2));
    }

    /**
     * @test
     */
    public function given_a_bad_garmenttype_and_valid_sizevalue_when_insert_then_return_non_valid_garmenttype()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->with(2)
            ->willReturn(null);
        $this->expectException(GarmentTypeNotExistsException::class);
        $this->handler->handle(new InsertNewSizeCommand(2, 2));
    }
}
