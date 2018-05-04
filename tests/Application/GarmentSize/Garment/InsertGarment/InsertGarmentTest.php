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
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentType;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeCommand;
use Inventory\Management\Application\GarmentSize\Garment\InsertGarmentType\InsertGarmentTypeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Domain\Model\Service\FindGarmentTypeIfExists;
use Inventory\Management\Domain\Model\Service\GarmentNameExists;
use Inventory\Management\Domain\Model\Service\GarmentTypeNameExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class InsertGarmentTest extends TestCase
{
    /**
     * @test
     */
    public function given_a_valid_garment_when_it_does_not_exist_then_insert()
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
            ->willReturn(null);
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