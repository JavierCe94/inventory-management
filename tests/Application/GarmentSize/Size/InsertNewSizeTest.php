<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 4/05/18
 * Time: 9:11
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSize;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeCommand;
use Inventory\Management\Application\GarmentSize\Size\InsertNewSize\InsertNewSizeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\Size;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeAlreadyExist;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Service\GarmentSize\Size\CheckIfSizeEntityExist;
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
        $this->sizeRepositoryStub = $this->createMock(SizeRepositoryInterface::class);
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepositoryInterface::class);


        $this->handler = new InsertNewSize(
            $this->sizeRepositoryStub,
            new FindGarmentTypeIfExists($this->garmentTypeRepositoryStub),
            new CheckIfSizeEntityExist($this->sizeRepositoryStub),
            new InsertNewSizeTransform()
        );
    }

    /**
     * @test
     */
    public function
    given_a_valid_sizevalue_and_garmenttype_when_they_are_not_already_created_then_insert_into_size_table()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));

        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn(null);

        $this->sizeRepositoryStub->method('addSize')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($this->createMock(Size::class));

        $this->sizeRepositoryStub->expects($this->once())
            ->method('persistAndFlush');

        $this->handler->handle(new InsertNewSizeCommand(2, 2));
    }

    /**
     * @test
     */
    public function given_a_valid_garmenttype_and_valid_sizevalue_when_already_created_then_expect_exception()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));

        $this->sizeRepositoryStub->method('findSizeBySizeValueAndGarmentType')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn(Size::class);

        $this->expectException(SizeAlreadyExist::class);
        $this->handler->handle(new InsertNewSizeCommand(2, 2));
    }

    /**
     * @test
     */
    public function given_a_bad_garmenttype_and_valid_sizevalue_when_insert_then_return_non_valid_garmenttype()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);

        $output = $this->handler->handle(new InsertNewSizeCommand(2, 2));

        $this->assertEquals(["No existe ese tipo de prenda"], $output);
    }
}