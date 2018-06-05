<?php

namespace Inventory\Management\Tests\Application\GarmentSize\CreateGarmentSizeTable;

use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTable;
use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTableCommand;
use Inventory\Management\Application\GarmentSize\CreateGarmentSizeTable\CreateGarmentSizeTableTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypesAreNotEquals;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeAlreadyExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Service\GarmentSize\CheckGarmentSizeExist;
use Inventory\Management\Domain\Service\GarmentSize\Garment\CheckGarmentTypeAreEquals;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeIfExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Infrastructure\Repository\GarmentSize\GarmentSizeRepository;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Size\SizeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateGarmentSizeTableTest extends TestCase
{
    /**
     * @var CreateGarmentSizeTable
     */
    private $handler;

    /**
     * @var MockObject
     */
    private $garmentSizeRepositoryStub;

    /**
     * @var MockObject
     */
    private $sizeRepositoryStub;

    /**
     * @var MockObject
     */
    private $garmentRepositoryStub;

    /**
     * @var MockObject
     */
    private $garmentSizeMock;

    /**
     * @var MockObject
     */
    private $sizeMock;

    /**
     * @var MockObject
     */
    private $garmentMock;


    public function setUp()
    {
        $this->garmentRepositoryStub = $this->createMock(GarmentRepository::class);
        $this->sizeRepositoryStub = $this->createMock(SizeRepository::class);
        $this->garmentSizeRepositoryStub = $this->createMock(
            GarmentSizeRepository::class
        );
        $this->garmentMock = $this->createMock(Garment::class);
        $this->sizeMock = $this->createMock(Size::class);
        $this->garmentSizeMock = $this->createMock(GarmentSize::class);



        $this->handler = new CreateGarmentSizeTable(
            $this->garmentSizeRepositoryStub,
            new FindGarmentIfExists($this->garmentRepositoryStub),
            new FindSizeIfExists($this->sizeRepositoryStub),
            new CheckGarmentSizeExist($this->garmentSizeRepositoryStub),
            new CheckGarmentTypeAreEquals(),
            new CreateGarmentSizeTableTransform()
        );
    }

    /**
     * @test
     */
    public function given_a_valid_garment_a_valid_size_the_combination_is_not_already_created_and_garmetntypes_from_size_and_garment_are_equals_when_try_to_create_then_succes()
    {
        $garmentTypeMock = $this->createMock(GarmentType::class);

        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(1, 1)
            ->willReturn($this->sizeMock);

        $this->garmentRepositoryStub->method('findGarmentById')
            ->with(1)
            ->willReturn($this->garmentMock);

        $this->garmentMock->method('getId')->willReturn(1);
        $this->sizeMock->method('getId')->willReturn(1);
        $this->garmentMock->method('getGarmentType')->willReturn($garmentTypeMock);
        $this->sizeMock->method('getGarmentType')->willReturn($garmentTypeMock);

        $this->garmentSizeRepositoryStub->method('findByGarmentAndSizeId')
            ->with(1, 1)
            ->willReturn(null);

        $this->garmentSizeRepositoryStub->expects($this->once())
            ->method('createGarmentSize');

        $this->handler->handle(new CreateGarmentSizeTableCommand(1, 1, 1));
    }

    /**
     * @test
     */
    public function given_a_valid_garment_a_valid_size_the_combination_is_not_already_created_and_garmetntypes_from_size_and_garment_are_not_equals_when_try_to_create_then_exception()
    {
        $garmentTypeMock = $this->createMock(GarmentType::class);
        $garmentTypeMock2 = $this->createMock(GarmentType::class);

        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(1, 1)
            ->willReturn($this->sizeMock);

        $this->garmentRepositoryStub->method('findGarmentById')
            ->with(1)
            ->willReturn($this->garmentMock);

        $this->garmentMock->method('getId')->willReturn(1);
        $this->sizeMock->method('getId')->willReturn(1);
        $this->garmentMock->method('getGarmentType')->willReturn($garmentTypeMock);
        $this->sizeMock->method('getGarmentType')->willReturn($garmentTypeMock2);

        $this->expectException(GarmentTypesAreNotEquals::class);
        $this->handler->handle(new CreateGarmentSizeTableCommand(1, 1, 1));
    }

    /**
     * @test
     */
    public function given_a_valid_garment_a_valid_size_the_combination_is_already_create_when_create_exception()
    {
        $garmentTypeMock = $this->createMock(GarmentType::class);

        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(1, 1)
            ->willReturn($this->sizeMock);

        $this->garmentRepositoryStub->method('findGarmentById')
            ->with(1)
            ->willReturn($this->garmentMock);

        $this->garmentMock->method('getId')->willReturn(1);
        $this->sizeMock->method('getId')->willReturn(1);
        $this->garmentMock->method('getGarmentType')->willReturn($garmentTypeMock);
        $this->sizeMock->method('getGarmentType')->willReturn($garmentTypeMock);

        $this->garmentSizeRepositoryStub->method('findByGarmentAndSizeId')
            ->with(1, 1)
            ->willReturn($this->garmentSizeMock);

        $this->expectException(GarmentSizeAlreadyExist::class);
        $this->handler->handle(new CreateGarmentSizeTableCommand(1, 1, 1));
    }

    /**
     * @test
     */
    public function given_a_valid_garment_a_bad_size_when_create_exception()
    {
        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(1, 1)
            ->willReturn(null);

        $this->garmentRepositoryStub->method('findGarmentById')
            ->with(1)
            ->willReturn($this->garmentMock);


        $this->expectException(SizeDoNotExist::class);
        $this->handler->handle(new CreateGarmentSizeTableCommand(1, 1, 1));
    }

    /**
     * @test
     */
    public function given_a_bad_garment_a_valid_size_when_create_exception()
    {
        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(1, 1)
            ->willReturn($this->sizeMock);

        $this->garmentRepositoryStub->method('findGarmentById')
            ->with(1)
            ->willReturn(null);


        $this->expectException(GarmentNotExistsException::class);
        $this->handler->handle(new CreateGarmentSizeTableCommand(1, 1, 1));
    }
}
