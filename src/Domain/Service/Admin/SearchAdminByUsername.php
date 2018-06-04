<?php

namespace Inventory\Management\Domain\Service\Admin;

use Inventory\Management\Domain\Model\Entity\Admin\Admin;
use Inventory\Management\Domain\Model\Entity\Admin\AdminRepository;
use Inventory\Management\Domain\Model\Entity\Admin\NotFoundAdminsException;
use Inventory\Management\Domain\Model\Entity\Admin\SearchAdminByUsername as SearchAdminByUsernameI;

class SearchAdminByUsername implements SearchAdminByUsernameI
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * @throws NotFoundAdminsException
     */
    public function execute(string $username): ?Admin
    {
        $resultAdmin = $this->adminRepository->findAdminByUsername($username);
        if (null === $resultAdmin) {
            throw new NotFoundAdminsException();
        }

        return $resultAdmin;
    }
}
