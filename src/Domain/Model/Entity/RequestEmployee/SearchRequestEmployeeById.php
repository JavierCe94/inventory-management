<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

interface SearchRequestEmployeeById
{
    public function execute(int $id): RequestEmployee;
}
