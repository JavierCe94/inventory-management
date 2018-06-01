<?php

namespace Inventory\Management\Infrastructure\Util\Specification\Employee;

use Doctrine\ORM\QueryBuilder;
use Inventory\Management\Domain\Model\Specification\Specification;

class FilterEmployeeBySubDepartment implements Specification
{
    private $subDepartment;

    public function __construct(?int $subDepartment)
    {
        $this->subDepartment = $subDepartment;
    }

    public function match(QueryBuilder $queryBuilder)
    {
        if (null !== $this->subDepartment && 0 !== $this->subDepartment) {
            $queryBuilder->andWhere('ems.subDepartment = :subDepartment');
            $queryBuilder->setParameter('subDepartment', $this->subDepartment);
        }

        return $queryBuilder->expr()->eq('ems.subDepartment', ':subDepartment');
    }
}
