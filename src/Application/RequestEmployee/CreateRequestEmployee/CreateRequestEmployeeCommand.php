<?php

namespace Inventory\Management\Application\RequestEmployee\CreateRequestEmployee;

class CreateRequestEmployeeCommand
{
    private $nif;

    public function __construct($nif)
    {
        $this->nif = $nif;
    }

    public function nif(): string
    {
        return $this->nif;
    }
}
