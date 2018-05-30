<?php

namespace Inventory\Management\Tests\Application\Employee\UpdateBasicFieldsEmployee;

use Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee\UpdateBasicFieldsEmployee;
use Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee\UpdateBasicFieldsEmployeeCommand;
use Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee\UpdateBasicFieldsEmployeeTransform;
use Inventory\Management\Domain\Model\Entity\Employee\Employee;
use Inventory\Management\Domain\Model\Entity\Employee\FoundTelephoneEmployeeException;
use Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException;
use Inventory\Management\Domain\Service\Employee\CheckNotExistTelephoneEmployee;
use Inventory\Management\Domain\Service\PasswordHash\EncryptPassword;
use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;
use Inventory\Management\Infrastructure\Repository\Employee\EmployeeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateBasicFieldsEmployeeTest extends TestCase
{
    /* @var MockObject $employeeRepository */
    private $employeeRepository;
    /* @var MockObject $encryptPassword */
    private $encryptPassword;
    private $updateBasicFieldsEmployeeCommand;
    private $transform;

    public function setUp(): void
    {
        $this->employeeRepository = $this->createMock(EmployeeRepository::class);
        $this->encryptPassword = $this->createMock(EncryptPassword::class);
        $dataToken = json_decode(
            json_encode([
                'nif' => '78965423D'
            ])
        );
        $this->updateBasicFieldsEmployeeCommand = new UpdateBasicFieldsEmployeeCommand(
            $dataToken,
            'Javier',
            '1234',
            '689354127'
        );
        $this->transform = new UpdateBasicFieldsEmployeeTransform();
    }

    /**
     * @test
     */
    public function given_employee_when_nif_is_or_not_encountered_then_telephone_found_exception(): void
    {
        $nif = '78965423D';
        $telephone = '689354127';
        $employee = $this->createMock(Employee::class);
        $this->employeeRepository->method('findEmployeeByNif')
            ->with($nif)
            ->willReturn($employee);
        $this->employeeRepository->method('checkNotExistsTelephoneEmployee')
            ->with($telephone, $nif)
            ->willReturn($employee);
        $searchEmployeeByNif = new SearchEmployeeByNif($this->employeeRepository);
        $checkNotExistTelephoneEmployee = new CheckNotExistTelephoneEmployee($this->employeeRepository);
        $updateBasicFieldsEmployee = new UpdateBasicFieldsEmployee(
            $this->employeeRepository,
            $this->transform,
            $searchEmployeeByNif,
            $checkNotExistTelephoneEmployee,
            $this->encryptPassword
        );
        $this->expectException(FoundTelephoneEmployeeException::class);
        $updateBasicFieldsEmployee->handle($this->updateBasicFieldsEmployeeCommand);
    }

    /**
     * @test
     */
    public function given_employee_when_nif_is_not_encountered_then_employee_not_found_exception(): void
    {
        $nif = '78965423D';
        $this->employeeRepository->method('findEmployeeByNif')
            ->with($nif)
            ->willReturn(null);
        $searchEmployeeByNif = new SearchEmployeeByNif($this->employeeRepository);
        $checkNotExistTelephoneEmployee = new CheckNotExistTelephoneEmployee($this->employeeRepository);
        $updateBasicFieldsEmployee = new UpdateBasicFieldsEmployee(
            $this->employeeRepository,
            $this->transform,
            $searchEmployeeByNif,
            $checkNotExistTelephoneEmployee,
            $this->encryptPassword
        );
        $this->expectException(NotFoundEmployeesException::class);
        $updateBasicFieldsEmployee->handle($this->updateBasicFieldsEmployeeCommand);
    }

    /**
     * @test
     */
    public function given_employee_when_nif_is_encountered_then_update(): void
    {
        $nif = '78965423D';
        $password = '$2afs58erg2g68wj1ol2g89t3f1dgf4g7g5gd2';
        $name = 'Javier';
        $telephone = '689354127';
        $employee = $this->createMock(Employee::class);
        $employee->method('getId')
            ->willReturn(1);
        $employee->method('getNif')
            ->willReturn($nif);
        $employee->method('getPassword')
            ->willReturn($password);
        $employee->method('getName')
            ->willReturn($name);
        $employee->method('getTelephone')
            ->willReturn($telephone);
        $this->employeeRepository->method('findEmployeeByNif')
            ->with($nif)
            ->willReturn($employee);
        $this->employeeRepository->method('checkNotExistsTelephoneEmployee')
            ->with($telephone)
            ->willReturn(null);
        $this->employeeRepository->method('updateBasicFieldsEmployee')
            ->with($employee, $password, $name, $telephone)
            ->willReturn($employee);
        $searchEmployeeByNif = new SearchEmployeeByNif($this->employeeRepository);
        $checkNotExistTelephoneEmployee = new CheckNotExistTelephoneEmployee($this->employeeRepository);
        $this->encryptPassword->method('execute')
            ->with('1234')
            ->willReturn('$2afs58erg2g68wj1ol2g89t3f1dgf4g7g5gd2');
        $updateBasicFieldsEmployee = new UpdateBasicFieldsEmployee(
            $this->employeeRepository,
            $this->transform,
            $searchEmployeeByNif,
            $checkNotExistTelephoneEmployee,
            $this->encryptPassword
        );
        $updateBasicFieldsEmployee->handle($this->updateBasicFieldsEmployeeCommand);
        $this->assertTrue(true, true);
    }
}
