<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 4/05/18
 * Time: 8:51
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\InsertGarmentType;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
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

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepositoryInterface::class);

        $this->handler = new InsertGarmentType(
            $this->garmentTypeRepositoryStub,
            new InsertGarmentTypeTransform(),
            new GarmentTypeNameExists($this->garmentTypeRepositoryStub)
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
            ->method('persistAndFlush');

        $output = $this->handler->handle(new InsertGarmentTypeCommand('zapatillas'));

        $this->assertEquals(200, $output['code']);
    }

    /**
     * @test
     */
    public function given_a_valid_garmentType_when_it_exists_then_catch_excepction()
    {
        $this->garmentTypeRepositoryStub->method('findGarmentTypeByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));

        $output = $this->handler->handle(new InsertGarmentTypeCommand('poncho'));

        $this->assertEquals(409, $output['code']);    }
}
