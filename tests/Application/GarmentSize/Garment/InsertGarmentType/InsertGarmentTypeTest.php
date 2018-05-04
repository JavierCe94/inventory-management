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
use Inventory\Management\Domain\Model\Service\GarmentTypeNameExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class InsertGarmentTypeTest extends TestCase
{
    /**
     * @test
     */
    public function given_a_valid_garmentType_when_it_does_not_exist_then_insert()
    {
        $garmentTypeRepository = $this
            ->getMockBuilder(GarmentTypeRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentTypeRepository->method('findGarmentTypeByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);

        $insertGarmentTypeTransform = new InsertGarmentTypeTransform();
        $garmentTypeNameExists = new GarmentTypeNameExists($garmentTypeRepository);

        $insertGarmentType = new InsertGarmentType(
            $garmentTypeRepository,
            $insertGarmentTypeTransform,
            $garmentTypeNameExists
        );
        $output = $insertGarmentType->handle(new InsertGarmentTypeCommand('zapatillas'));

        $this->assertEquals('GarmentType insertado con exito', $output);
    }

    /**
     * @test
     */
    public function given_a_valid_garmentType_when_it_exists_then_catch_excepction()
    {
        $garmentTypeEntity = $this
            ->getMockBuilder(GarmentType::class)
            ->disableOriginalConstructor()->getMock();

        $garmentTypeRepository = $this
            ->getMockBuilder(GarmentTypeRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentTypeRepository->method('findGarmentTypeByName')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentTypeEntity);

        $insertGarmentTypeTransform = new InsertGarmentTypeTransform();
        $garmentTypeNameExists = new GarmentTypeNameExists($garmentTypeRepository);

        $insertGarmentType = new InsertGarmentType(
            $garmentTypeRepository,
            $insertGarmentTypeTransform,
            $garmentTypeNameExists
        );
        $output = $insertGarmentType->handle(new InsertGarmentTypeCommand('poncho'));

        $this->assertEquals('El tipo de prenda ya existe', $output);
    }
}
