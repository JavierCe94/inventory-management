<?php

namespace Inventory\Management\Application\Employee\ShowDataEmployee;

class ShowDataEmployeeCommand
{
    private $dataToken;
    
    public function __construct($dataToken)
    {
        $this->dataToken = $dataToken;
    }
    
    public function dataToken(): object
    {
        return $this->dataToken;
    }
}
