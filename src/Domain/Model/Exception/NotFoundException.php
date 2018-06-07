<?php

namespace Inventory\Management\Domain\Model\Exception;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

abstract class NotFoundException extends \Exception
{
    public function __construct()
    {
        $code = HttpResponses::NOT_FOUND;
        parent::__construct($this->message(), $code);
    }

    abstract public function message(): string;
}
