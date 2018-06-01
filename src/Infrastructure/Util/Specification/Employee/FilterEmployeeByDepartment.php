<?php

namespace Inventory\Management\Infrastructure\Util\Specification\Employee;

use Doctrine\ORM\QueryBuilder;
use Inventory\Management\Domain\Model\Specification\Specification;

class FilterEmployeeByDepartment implements Specification
{
    private $department;

    public function __construct(?int $department)
    {
        $this->department = $department;
    }

    public function match(QueryBuilder $queryBuilder)
    {
        if (null !== $this->department && 0 !== $this->department) {
            $queryBuilder->andWhere('ems.department = :department');
            $queryBuilder->setParameter('department', $this->department);
        }

        return $queryBuilder->expr()->eq('ems.department', ':department');
    }
}
