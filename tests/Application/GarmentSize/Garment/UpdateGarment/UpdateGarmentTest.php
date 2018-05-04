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
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentRepositoryInterface;
use Inventory\Management\Domain\Model\Entity\GarmentSize\Garment\GarmentTypeRepositoryInterface;
use Inventory\Management\Domain\Model\Service\FindGarmentIfExists;
use Inventory\Management\Infrastructure\Repository\GarmentSize\Garment\GarmentRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateGarmentTest extends TestCase
{
    /**
     * @var UpdateGarment
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
        $this->handler = new UpdateGarment(
            $this->garmentRepositoryStub,
            new UpdateGarmentTransform(),
            new FindGarmentIfExists($this->garmentRepositoryStub)
        );
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_exists_then_update()
    {
        $id = 2;
        $name = 'poncho floreado';
        $garmentEntity = $this->createMock(Garment::class);
        $garmentEntity->method('getId')->willReturn($id);
        $garmentEntity->method('getName')->willReturn($name);


        $this->garmentRepositoryStub->method('findGarmentById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn($garmentEntity);

        $this->garmentRepositoryStub->expects($this->once())
            ->method('updateGarment');

        $output = $this->handler->handle(new UpdateGarmentCommand($id, $name));

        $this->assertEquals('Garment actualizado con exito', $output);
    }

    /**
     * @test
     */
    public function given_new_data_when_table_entry_does_not_exists_then_show_message()
    {
        $id = 2;
        $name = 'poncho floreado';

        $this->garmentRepositoryStub->method('findGarmentById')
            ->withConsecutive($this->returnValue(true))
            ->willReturn(null);

        $output = $this->handler->handle(new UpdateGarmentCommand($id, $name));

        $this->assertEquals('La prenda que quiere editar no existe', $output);
    }
}