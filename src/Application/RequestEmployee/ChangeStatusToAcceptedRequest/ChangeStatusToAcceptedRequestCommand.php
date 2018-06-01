<?php

namespace Inventory\Management\Application\RequestEmployee\ChangeStatusToAcceptedRequest;

class ChangeStatusToAcceptedRequestCommand
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
