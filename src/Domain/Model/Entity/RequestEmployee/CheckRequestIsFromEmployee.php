<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

interface CheckRequestIsFromEmployee
{
    public function execute(string $nifEmployee, int $idRequestEmployee): RequestEmployee;
}
