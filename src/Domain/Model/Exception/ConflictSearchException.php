<?php

namespace Inventory\Management\Domain\Model\Exception;

use Inventory\Management\Domain\Model\HttpResponses\HttpResponses;

abstract class ConflictSearchException extends \Exception
{
    public function __construct()
    {
        $code = HttpResponses::CONFLICT_SEARCH;
        parent::__construct($this->message(), $code);
    }

    abstract public function message(): string;
}
