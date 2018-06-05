<?php

namespace Inventory\Management\Application\RequestEmployee\CreateRequestEmployeeGarments;

class CreateRequestEmployeeGarmentsCommand
{
    private $employee;
    private $requestEmployee;
    private $garment;
    private $size;
    private $count;

    public function __construct($employee, $requestEmployee, $garment, $size, $count)
    {
        $this->employee = $employee;
        $this->requestEmployee = $requestEmployee;
        $this->garment = $garment;
        $this->size = $size;
        $this->count = $count;
    }

    public function employee(): int
    {
        return $this->employee;
    }

    public function requestEmployee(): int
    {
        return $this->requestEmployee;
    }

    public function garment(): int
    {
        return $this->garment;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function count(): int
    {
        return $this->count;
    }
}
