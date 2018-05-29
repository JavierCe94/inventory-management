<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 27/04/18
 * Time: 11:23
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\ListGarment;

use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarment;
use Inventory\Management\Application\GarmentSize\Garment\ListGarment\ListGarmentTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentType;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use PHPUnit\Framework\TestCase;

class ListGarmentTest extends TestCase
{
    /**
     * @test
     */
    public function given_ListGarment_when_table_is_not_Empty_then_show()
    {
        $idGarmentType = 2;
        $nameGarmentType = 'poncho';
        $garmentTypeEntity = $this->createMock(GarmentType::class);
        $garmentTypeEntity->method('getId')->willReturn($idGarmentType);
        $garmentTypeEntity->method('getName')->willReturn($nameGarmentType);

        $idGarment = 1;
        $nameGarment = 'poncho de flores';
        $garmentEntity = $this->createMock(Garment::class);
        $garmentEntity->method('getId')->willReturn($idGarment);
        $garmentEntity->method('getName')->willReturn($nameGarment);
        $garmentEntity->method('getGarmentType')->willReturn($garmentTypeEntity);

        $listGarmentRepository = $this->createMock(GarmentRepository::class);
        $listGarmentRepository->method('listGarment')->willReturn([$garmentEntity]);
        $listGarmentTransform = new ListGarmentTransform();

        $output = (new ListGarment($listGarmentRepository, $listGarmentTransform))->handle();

        $this->assertArraySubset(
            [["id" => 1,"name" => "poncho de flores", "garment_type" => ["id" => 2, "name" => "poncho"]]],
            $output
        );
    }
}