<?php

namespace Inventory\Management\Domain\Model\Entity\Employee;

interface CheckNotExistsUniqueFields
{
    public function execute(
        string $nif,
        string $inSsNumber,
        string $telephone,
        string $codeEmployee
    ): void;
}
