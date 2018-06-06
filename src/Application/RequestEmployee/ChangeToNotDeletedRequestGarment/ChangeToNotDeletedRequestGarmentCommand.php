<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeToNotDeletedRequestGarment;

class ChangeToNotDeletedRequestGarmentCommand
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
