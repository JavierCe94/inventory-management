<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

interface SearchRequestGarmentById
{
    public function execute(int $id): RequestEmployeeGarment;
}
