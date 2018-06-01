<?php

namespace Inventory\Management\Application\RequestEmployee\ShowRequestsEmployee;

class ShowRequestsEmployeeCommand
{
    private $nif;
    private $status;
    
    public function __construct($nif, $status)
    {
        $this->nif = $nif;
        $this->status = $status;
    }
    
    public function nif(): string
    {
        return $this->nif;
    }
    
    public function status(): ?string
    {
        return $this->status;
    }
}
