<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

interface CheckRequestGarmentIsFromEmployee
{
    public function execute(string $nifEmployee, int $idRequestGarment): RequestEmployeeGarment;
}
