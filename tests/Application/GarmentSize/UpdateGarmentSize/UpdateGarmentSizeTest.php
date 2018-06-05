<?php

namespace Inventory\Management\Tests\Application\GarmentSize\UpdateGarmentSize;

use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSize;
use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSizeCommand;
use Inventory\Management\Application\GarmentSize\UpdateGarmentSize\UpdateGarmentSizeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypesAreNotEquals;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSize;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;
use Inventory\Management\Domain\Service\GarmentSize\FindGarmentSizeIfExist;
use Inventory\Management\Domain\Service\GarmentSize\Garment\CheckGarmentTypeAreEquals;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeIfExists;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateGarmentSizeTest extends TestCase
{
    /**
     * @var UpdateGarmentSize
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



        $this->handler = new UpdateGarmentSize(
            $this->garmentSizeRepositoryStub,
            new FindGarmentIfExists($this->garmentRepositoryStub),
            new FindSizeIfExists($this->sizeRepositoryStub),
            new FindGarmentSizeIfExist($this->garmentSizeRepositoryStub),
            new CheckGarmentTypeAreEquals(),
            new UpdateGarmentSizeTransform()
        );
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
        $this->handler->handle(new UpdateGarmentSizeCommand(1, 1, 1, 1));
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
        $this->handler->handle(new UpdateGarmentSizeCommand(1, 1, 1, 1));
    }


    /**
     * @test
     */
    public function given_a_valid_garment_a_valid_size_the_combination_is_already_created_and_garmetntypes_from_size_and_garment_are_not_equals_when_try_to_create_then_exception()
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
        $this->handler->handle(new UpdateGarmentSizeCommand(1, 1, 1, 1));
    }

    /**
     * @test
     */
    public function given_a_valid_garment_a_valid_size_the_combination_is_already_created_and_garmetntypes_from_size_and_garment_are_equals_when_try_to_update_then_succes()
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

        $this->garmentSizeRepositoryStub->expects($this->once())
            ->method('updateStockGarmentSize');

        $this->handler->handle(new UpdateGarmentSizeCommand(1, 1, 1, 1));
    }

    /**
     * @test
     */
    public function given_a_valid_garment_a_valid_size_the_combination_do_not_exist_and_garmetntypes_from_size_and_garment_are_equals_when_try_to_update_then_succes()
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


        $this->expectException(GarmentSizeNotExist::class);
        $this->handler->handle(new UpdateGarmentSizeCommand(1, 1, 1, 1));
    }

}
