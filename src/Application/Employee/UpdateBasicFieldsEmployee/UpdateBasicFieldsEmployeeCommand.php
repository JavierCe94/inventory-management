<?php

namespace Inventory\Management\Application\Employee\UpdateBasicFieldsEmployee;

class UpdateBasicFieldsEmployeeCommand
{
    private $dataToken;
    private $name;
    private $password;
    private $telephone;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($dataToken, $name, $password, $telephone)
    {
        $this->dataToken = $dataToken;
        $this->name = $name;
        $this->password = $password;
        $this->telephone = $telephone;
    }

    public function dataToken(): object
    {
        return $this->dataToken;
    }
    
    public function name(): string
    {
        return $this->name;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function telephone(): string
    {
        return $this->telephone;
    }
}
