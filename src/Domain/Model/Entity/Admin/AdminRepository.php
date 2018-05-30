<?php

namespace Inventory\Management\Domain\Model\Entity\Admin;

interface AdminRepository
{
    public function findAdminByUsername(string $username): ?Admin;
}
