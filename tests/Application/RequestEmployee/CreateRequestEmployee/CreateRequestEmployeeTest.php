<?php

namespace Inventory\management\tests\Application\RequestEmployee\CreateRequestEmployee;

use Inventory\Management\Application\RequestEmployee\CreateRequestEmployee\CreateRequestEmployeeTransform;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\Entity\RequestEmployee\RequestEmployeeRepository;
use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Inventory\Management\Application\RequestEmployee\CreateRequestEmployee\CreateRequestEmployee;

class CreateRequestEmployeeTest extends TestCase
{
    /**
     * @var CreateRequestEmployee
     */
    private $handler;

    /**
     * @var MockObject
     */
    private $requestEmployeeRepository;

    /**
     * @var MockObject
     */
    private $employeeRepository;

    public function setUp()
    {
        $this->requestEmployeeRepository = $this->createMock(RequestEmployeeRepository::class);
        $this->employeeRepository = $this->createMock(EmployeeRepository::class);

        $this->handler = new CreateRequestEmployee(
            $this->requestEmployeeRepository,
            new CreateRequestEmployeeTransform(),
            new SearchEmployeeByNif($this->employeeRepository)
        );
    }
}
