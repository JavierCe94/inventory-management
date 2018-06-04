<?php

namespace Inventory\Management\Infrastructure\Repository\Admin;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Inventory\Management\Domain\Model\Entity\Admin\Admin;
use Inventory\Management\Domain\Model\Entity\Admin\AdminRepository as AdminRepositoryI;

class AdminRepository extends ServiceEntityRepository implements AdminRepositoryI
{
    /**
     * @return object|Admin
     */
    public function findAdminByUsername(string $username): ?Admin
    {
        return $this->findOneBy(['username' => $username, 'disabledAdmin' => false]);
    }
}
