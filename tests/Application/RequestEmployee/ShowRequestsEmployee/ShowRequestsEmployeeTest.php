<?php

namespace Inventory\Management\tests\Application\RequestEmployee\ShowRequestsEmployee;

use Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee\ShowRequestsEmployee;
use Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee\ShowRequestsEmployeeTransform;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ShowRequestsEmployeeTest extends TestCase
{
    /**
     * @var ShowRequestsEmployee
     */
    private $handler;

    /**
     * @var MockObject
     */
    private $requestEmployeeRepository;

    public function setUp()
    {
        $this->requestEmployeeRepository = $this->createMock(RequestEmployeeRepository::class);

        $this->handler = new ShowRequestsEmployee(
            $this->requestEmployeeRepository,
            new ShowRequestsEmployeeTransform()
        );
    }
}
