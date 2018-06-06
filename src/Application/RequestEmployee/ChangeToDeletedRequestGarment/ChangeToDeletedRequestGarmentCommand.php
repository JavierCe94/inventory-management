<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToDeletedRequestGarment;

class ChangeToDeletedRequestGarmentCommand
{
    private $nifEmployee;
    private $idRequestGarment;

    public function __construct($nifEmployee, $idRequestGarment)
    {
        $this->nifEmployee = $nifEmployee;
        $this->idRequestGarment = $idRequestGarment;
    }

    public function nifEmployee(): string
    {
        return $this->nifEmployee;
    }

    public function idRequestGarment(): int
    {
        return $this->idRequestGarment;
    }
}
