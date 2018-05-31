<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSize;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSize;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeCommand;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryI;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeAlreadyExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryI;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateSizeTest extends TestCase
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
        $this->sizeRepositoryStub = $this->createMock(SizeRepositoryI::class);
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepositoryI::class);
        $this->handler = new UpdateSize(
            $this->sizeRepositoryStub,
            new FindGarmentTypeIfExists($this->garmentTypeRepositoryStub),
            new UpdateSizeTransform(),
            new FindSizeEntityIfExists($this->sizeRepositoryStub)
        );
    }
    
    /**
     * @test
     */
    public function given_a_valid_sizevalue_a_newsizevalue_and_valid_garmenttype_when_update_then_success()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));
        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($this->createMock(Size::class));
        $this->sizeRepositoryStub->method('updateSize')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($this->createMock(Size::class));
        $this->sizeRepositoryStub->expects($this->once())
            ->method('persistAndFlush');
        $this->handler->handle(new UpdateSizeCommand(2, 2, 30));
        $this->assertTrue(true, true);
    }

    /**
     * @test
     */
    public function given_a_bad_garmenttype_and_valid_sizevalue_when_insert_then_expect_exception()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $this->expectException(GarmentTypeNotExistsException::class);
        $this->handler->handle(new UpdateSizeCommand(2, 2, 30));
    }

    /**
     * @test
     */
    public function given_a_good_garmenttype_but_a_size_who_dont_exist_when_update_then_expect_exception()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->with(true)
            ->willReturn($this->createMock(GarmentType::class));
        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->with(true, true)
            ->willReturn(null);
        $this->expectException(SizeAlreadyExist::class);
        $this->handler->handle(new UpdateSizeCommand(2, 5, 30));
    }
}
