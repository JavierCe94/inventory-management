<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 4/05/18
 * Time: 9:31
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\InsertGarment;

use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarment;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentCommand;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarment\InsertGarmentTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Service\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Service\GarmentNameExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
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


    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->garmentRepositoryStub = $this->createMock(GarmentRepositoryInterface::class);
        $this->garmentTypeRepositoryStub = $this->createMock(GarmentTypeRepositoryInterface::class);
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
            ->method('persistAndFlush');

        $this->garmentRepositoryStub->method('insertGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($this->createMock(Garment::class));

        $this->garmentTypeRepositoryStub->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($this->createMock(GarmentType::class));
        $output = $this->handler->handle(new InsertGarmentCommand('zapatillas', 3));

        $this->assertEquals('Garment insertado con exito', $output);
    }

    /**
     * @test
     */
    public function given_a_valid_garment_when_it_exists_then_catch_Garment_Name_Exists_Exception()
    {

        $garmentEntity = $this
            ->getMockBuilder(Garment::class)
            ->disableOriginalConstructor()->getMock();

        $garmentTypeEntity = $this
            ->getMockBuilder(GarmentType::class)
            ->disableOriginalConstructor()->getMock();

        $garmentRepository = $this
            ->getMockBuilder(GarmentRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentRepository->method('findGarmentByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentEntity);
        $garmentRepository->method('insertGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($garmentEntity);

        $garmentTypeRepository = $this
            ->getMockBuilder(GarmentTypeRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentTypeRepository->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentTypeEntity);

        $insertGarmentTransform = new InsertGarmentTransform();
        $findGarmentTypeIfExists = new FindGarmentTypeIfExists($garmentTypeRepository);
        $garmentNameExists = new GarmentNameExists($garmentRepository);

        $insertGarment = new InsertGarment(
            $garmentRepository,
            $garmentTypeRepository,
            $insertGarmentTransform,
            $garmentNameExists,
            $findGarmentTypeIfExists
        );
        $output = $insertGarment->handle(new InsertGarmentCommand('zapatillas', 3));

        $this->assertEquals('Nombre prenda ya existe', $output);
    }

    /**
     * @test
     */
    public function given_a_valid_garment_when_garmentType_does_not_exist_then_catch_GarmentTypeNotExistsException()
    {

        $garmentEntity = $this
            ->getMockBuilder(Garment::class)
            ->disableOriginalConstructor()->getMock();

        $garmentRepository = $this
            ->getMockBuilder(GarmentRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentRepository->method('findGarmentByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $garmentRepository->method('insertGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true))
            ->willReturn($garmentEntity);

        $garmentTypeRepository = $this
            ->getMockBuilder(GarmentTypeRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentTypeRepository->method('findGarmentTypeById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);

        $insertGarmentTransform = new InsertGarmentTransform();
        $findGarmentTypeIfExists = new FindGarmentTypeIfExists($garmentTypeRepository);
        $garmentNameExists = new GarmentNameExists($garmentRepository);

        $insertGarment = new InsertGarment(
            $garmentRepository,
            $garmentTypeRepository,
            $insertGarmentTransform,
            $garmentNameExists,
            $findGarmentTypeIfExists
        );
        $output = $insertGarment->handle(new InsertGarmentCommand('name', 3));

        $this->assertEquals('El tipo de prenda no existe', $output);
    }
}