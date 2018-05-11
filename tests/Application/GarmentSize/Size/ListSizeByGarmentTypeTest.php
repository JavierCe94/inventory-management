<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 4/05/18
 * Time: 9:20
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Size;


use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentType;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Size\ListSizeByGarmentType\ListSizeByGarmentTypeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Size\SizeRepositoryInterface;
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
        $this->sizeRepositoryStub = $this->createMock(SizeRepositoryInterface::class) ;
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepositoryInterface::class) ;

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
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);

        $output = $this->handler->handle(new ListSizeByGarmentTypeCommand(2));

        $this->assertEquals(["No existe ese tipo de prenda"], $output);
    }

    /**
     * @test
     */
    public function given_a_valid_garmenttype_when_try_to_list_then_succes()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));

        $this->sizeRepositoryStub->method('findByGarmentType')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(array());

        $output = $this->handler->handle(new ListSizeByGarmentTypeCommand(3));

        $this->assertEquals(array(), $output);
    }
}