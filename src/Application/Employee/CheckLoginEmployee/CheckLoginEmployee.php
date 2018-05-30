<?php

namespace Inventory\Management\Application\Employee\CheckLoginEmployee;

use Inventory\Management\Domain\Model\Entity\Employee\EmployeeRepository;
use Inventory\Management\Domain\Model\JwtToken\Roles;
use Inventory\Management\Domain\Service\PasswordHash\CheckDecryptPassword;
use Inventory\Management\Domain\Service\Employee\SearchEmployeeByNif;
use Inventory\Management\Domain\Service\JwtToken\CreateToken;

class CheckLoginEmployee
{
    private $employeeRepository;
    private $checkLoginEmployeeTransform;
    private $searchEmployeeByNif;
    private $checkDecryptPassword;
    private $createToken;

    public function __construct(
        EmployeeRepository $employeeRepository,
        CheckLoginEmployeeTransformI $checkLoginEmployeeTransform,
        SearchEmployeeByNif $searchEmployeeByNif,
        CheckDecryptPassword $checkDecryptPassword,
        CreateToken $createToken
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->checkLoginEmployeeTransform = $checkLoginEmployeeTransform;
        $this->searchEmployeeByNif = $searchEmployeeByNif;
        $this->checkDecryptPassword = $checkDecryptPassword;
        $this->createToken = $createToken;
    }

    /**
     * @param CheckLoginEmployeeCommand $checkLoginEmployeeCommand
     * @return string
     * @throws \Inventory\Management\Domain\Model\Entity\Employee\NotFoundEmployeesException
     * @throws \Inventory\Management\Domain\Model\PasswordHash\IncorrectPasswordException
     */
    public function handle(CheckLoginEmployeeCommand $checkLoginEmployeeCommand): string
    {
        $employee = $this->searchEmployeeByNif->execute(
            $checkLoginEmployeeCommand->nif()
        );
        $this->checkDecryptPassword->execute(
            $checkLoginEmployeeCommand->password(),
            null !== $employee ? $employee->getPassword() : ''
        );

        return $this->checkLoginEmployeeTransform->transform(
            $this->createToken->execute(
                Roles::ROLE_EMPLOYEE,
                [
                    'id' => $employee->getId(),
                    'nif' => $employee->getNif()
                ]
            )
        );
    }
}
