<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 4/05/18
 * Time: 9:20
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Size;


use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSize;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeCommand;
use Inventory\Management\Application\GarmentSize\Size\UpdateSize\UpdateSizeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeDoNotExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\FindSizeEntityIfExists;
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
        $this->sizeRepositoryStub = $this->createMock(SizeRepositoryInterface::class);
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepositoryInterface::class);


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
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));

        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn(null);

        $this->expectException(SizeDoNotExist::class);
        $this->handler->handle(new UpdateSizeCommand(2, 5, 30));
    }
}