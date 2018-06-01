<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Size;

use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentType;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeNotExistsException;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepository;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepository;
use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;
use Inventory\Management\Domain\Service\GarmentSize\Garment\FindGarmentTypeIfExists;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ListSizeByGarmentTypeTest extends TestCase
{
    /**
     * @var ListSizeByGarmentType
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
        $this->sizeRepositoryStub = $this->createMock(SizeRepository::class) ;
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepository::class) ;
        $this->handler = new ListSizeByGarmentType(
            $this->sizeRepositoryStub,
            new FindGarmentTypeIfExists($this->garmentTypeRepositoryStub),
            new ListSizeByGarmentTypeTransform()
        );
    }

    /**
     * @test
     */
    public function given_a_bad_garmenttype_when_try_to_list_then_return_non_valid_garmenttype()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->with(true)
            ->willReturn(null);
        $this->expectException(GarmentTypeNotExistsException::class);
        $this->handler->handle(new ListSizeByGarmentTypeCommand(2));
    }

    /**
     * @test
     */
    public function given_a_valid_garmenttype_when_try_to_list_then_succes()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->with(true)
            ->willReturn($this->createMock(GarmentType::class));
        $this->sizeRepositoryStub->method('findByGarmentType')
            ->with(true)
            ->willReturn(array());
        $this->handler->handle(new ListSizeByGarmentTypeCommand(3));
        $this->assertTrue(true, true);
    }
}
