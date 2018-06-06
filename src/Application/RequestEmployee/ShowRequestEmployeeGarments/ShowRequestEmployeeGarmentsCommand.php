<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestEmployeeGarments;

class ShowRequestEmployeeGarmentsCommand
{
    private $nifEmployee;
    private $idRequestEmployee;
    private $isDeleted;

    public function __construct($nifEmployee, $idRequestEmployee, $isDeleted)
    {
        $this->nifEmployee = $nifEmployee;
        $this->idRequestEmployee = $idRequestEmployee;
        $this->isDeleted = $isDeleted;
    }

    public function nifEmployee(): string
    {
        return $this->nifEmployee;
    }

    public function idRequestEmployee(): int
    {
        return $this->idRequestEmployee;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }
}
