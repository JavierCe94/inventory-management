<?php

namespace Inventory\Management\Tests\Application\Employee\ShowDataEmployee;

use Inventory\Management\Application\Employee\ShowDataEmployee\ShowDataEmployee;
use Inventory\Management\Application\Employee\ShowDataEmployee\ShowDataEmployeeCommand;
use Inventory\Management\Application\Employee\ShowDataEmployee\ShowDataEmployeeTransform;
use Inventory\Management\Domain\Model\Entity\Employee\Employee;
use Inventory\Management\Domain\Model\Entity\Employee\EmployeeStatus;
use Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException;
use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;
use Inventory\Management\Infrastructure\Repository\Employee\EmployeeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ShowDataEmployeeTest extends TestCase
{
    /* @var MockObject $employeeRepository */
    private $employeeRepository;
    private $showEmployeeByNifTransform;
    private $showDataEmployeeCommand;

    public function setUp()
    {
        $this->employeeRepository = $this->createMock(EmployeeRepository::class);
        $this->showEmployeeByNifTransform = new ShowDataEmployeeTransform();
        $dataToken = json_decode(
            json_encode([
                'nif' => 1
            ])
        );
        $this->showDataEmployeeCommand = new ShowDataEmployeeCommand($dataToken);
    }

    /**
     * @test
     */
    public function given_employee_when_nif_is_not_encountered_then_not_found_exception()
    {
        $this->employeeRepository->method('findEmployeeByNif')
            ->willReturn(null);
        $searchEmployeeByNif = new SearchEmployeeByNif($this->employeeRepository);
        $showEmployeeByNif = new ShowDataEmployee(
            $this->showEmployeeByNifTransform,
            $searchEmployeeByNif
        );
        $this->expectException(NotFoundEmployeesException::class);
        $showEmployeeByNif->handle($this->showDataEmployeeCommand);
    }

    /**
     * @test
     */
    public function given_employee_when_nif_is_encountered_then_ok_response()
    {
        $employeeStatus = $this->createMock(EmployeeStatus::class);
        $employee = $this->createMock(Employee::class);
        $employee->method('getId')
            ->willReturn(1);
        $employee->method('getImage')
            ->willReturn('image.jpg');
        $employee->method('getNif')
            ->willReturn('77685346D');
        $employee->method('getPassword')
            ->willReturn('1234');
        $employee->method('getName')
            ->willReturn('Javier');
        $employee->method('getInSsNumber')
            ->willReturn('456325789345');
        $employee->method('getTelephone')
            ->willReturn('649356871');
        $employee->method('getEmployeeStatus')
            ->willReturn($employeeStatus);
        $this->employeeRepository->method('findEmployeeByNif')
            ->willReturn($employee);
        $searchEmployeeByNif = new SearchEmployeeByNif($this->employeeRepository);
        $showEmployeeByNif = new ShowDataEmployee(
            $this->showEmployeeByNifTransform,
            $searchEmployeeByNif
        );
        $result = $showEmployeeByNif->handle($this->showDataEmployeeCommand);
        $this->assertArraySubset(
            [
                'name' => 'Javier'
            ],
            $result
        );
    }
}
