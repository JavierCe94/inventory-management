<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

interface CheckNotExistTelephoneEmployee
{
    public function execute(string $telephone, string $nif): void;
}
