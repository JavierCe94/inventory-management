<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToDeletedRequest;

class ChangeStatusToDeletedRequestCommand
{
    private $id;
    
    public function __construct($id)
    {
        $this->id = $id;
    }
    
    public function id(): int
    {
        return $this->id;
    }
}
