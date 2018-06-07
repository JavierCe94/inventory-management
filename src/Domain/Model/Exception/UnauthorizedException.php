<?php

namespace Inventory\Management\Domain\Model\Exception;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

abstract class UnauthorizedException extends \Exception
{
    public function __construct()
    {
        $code = HttpResponses::UNAUTHORIZED;
        parent::__construct($this->message(), $code);
    }

    abstract public function message(): string;
}
