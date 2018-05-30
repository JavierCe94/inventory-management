<?php

namespace Inventory\Management\Domain\Model\Entity\Admin;

interface SearchAdminByUsername
{
    public function execute(string $username): ?Admin;
}
