<?php

namespace Inventory\Management\Tests\Application\GarmentSize\ListGarmentSize;

use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSize;
use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSizeCommand;
use Inventory\Management\Application\GarmentSize\ListGarmentSize\ListGarmentSizeTransform;
use Inventory\Management\Domain\Model\Entity\GarmentSize\GarmentSizeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ListGarmentSizeTest extends TestCase
{
    /**
     * @var ListGarmentSize
     */
    private $handler;

    /**
     * @var MockObject
     */
    private $garmentSizeRepositoryStub;

    public function setUp()
    {
        $this->garmentSizeRepositoryStub = $this->createMock(
            GarmentSizeRepository::class
        );

        $this->handler = new ListGarmentSize(
            $this->garmentSizeRepositoryStub,
            new ListGarmentSizeTransform()
        );
    }

    /**
     * @test
     */

    public function given_a_call_when_try_to_list_succes()
    {
        $this->garmentSizeRepositoryStub->method('findAllGarmentSize')->willReturn(array());
        $this->handler->handle(new ListGarmentSizeCommand());
        $this->assertTrue(true, true);
    }
}
