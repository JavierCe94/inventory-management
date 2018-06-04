<?php

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\ListGarmentTypes;

use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypes;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypesCommand;
use Inventory\Management\Application\GarmentSize\Garment\ListGarmentTypes\ListGarmentTypesTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentTypeRepository;
use PHPUnit\Framework\TestCase;

class ListGarmentTypesTest extends TestCase
{
    /**
     * @test
     */
    public function given_ListGarmentTypes_when_table_is_not_Empty_then_show()
    {
        $id = 2;
        $name = 'poncho';
        $garmentTypeEntity = $this->createMock(GarmentType::class);
        $garmentTypeEntity->method('getId')->willReturn($id);
        $garmentTypeEntity->method('getName')->willReturn($name);
        $listGarmentTypeRepository = $this->createMock(GarmentTypeRepository::class);
        $listGarmentTypeRepository->method('listGarmentTypes')->willReturn([$garmentTypeEntity]);
        $listGarmentTypeTransform = new ListGarmentTypesTransform();
        $output = (new ListGarmentTypes($listGarmentTypeRepository, $listGarmentTypeTransform))
            ->handle(new ListGarmentTypesCommand());
        $this->assertArraySubset(
            [["id" => 2,"name" => "poncho"]],
            $output
        );
    }
}