<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 2/05/18
 * Time: 9:12
 */

namespace Inventory\Management\Tests\Application\GarmentSize\Garment\UpdateGarment;

use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarment;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentCommand;
use Inventory\Management\Application\GarmentSize\Garment\UpdateGarment\UpdateGarmentTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\Garment;
use Inventory\Management\Domain\Model\Service\FindGarmentIfExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use PHPUnit\Framework\TestCase;

class UpdateGarmentTest extends TestCase
{
    /**
     * @test
     */
    public function given_new_data_when_table_entry_exists_then_update()
    {
        $id = 2;
        $name = 'poncho floreado';
        $garmentEntity = $this
            ->getMockBuilder(Garment::class)
            ->disableOriginalConstructor()->getMock();
        $garmentEntity->method('getId')->willReturn($id);
        $garmentEntity->method('getName')->willReturn($name);

        $garmentRepository = $this
            ->getMockBuilder(GarmentRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentRepository->method('findGarmentById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentEntity);
        $garmentRepository->method('updateGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true));

        $findGarmentIfExist = new FindGarmentIfExists($garmentRepository);

        $updateGarmentTransform = new UpdateGarmentTransform();
        $updateGarment = new UpdateGarment($garmentRepository, $updateGarmentTransform, $findGarmentIfExist);
        $updateGarmentCommand = new UpdateGarmentCommand($id, $name);
        $updateGarment->handle($updateGarmentCommand);

        $this->assertEquals($garmentEntity->getId(), $updateGarmentCommand->getId());
        $this->assertEquals($garmentEntity->getName(), $updateGarmentCommand->getName());
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_does_not_exists_then_success()
    {
        $id = 2;
        $name = 'poncho floreado';

        $garmentRepository = $this
            ->getMockBuilder(GarmentRepository::class)
            ->disableOriginalConstructor()->getMock();
        $garmentRepository->method('findGarmentById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);
        $garmentRepository->method('updateGarment')
            ->withConsecutive($this->returnValue(true), $this->returnValue(true));

        $findGarmentIfExist = new FindGarmentIfExists($garmentRepository);

        $updateGarmentTransform = new UpdateGarmentTransform();

        $updateGarment = new UpdateGarment($garmentRepository, $updateGarmentTransform, $findGarmentIfExist);
        $updateGarment->handle(new UpdateGarmentCommand($id, $name));

        $this->assertTrue(true);
    }
}