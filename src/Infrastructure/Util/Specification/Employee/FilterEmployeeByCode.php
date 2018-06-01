<?php

namespace Inventory\Management\Infrastructure\Util\Specification\Employee;

use Doctrine\ORM\QueryBuilder;
use Inventory\Management\Domain\Model\Specification\Specification;

class FilterEmployeeByCode implements Specification
{
    private $code;

    public function __construct(?int $code)
    {
        $this->code = $code;
    }

    public function match(QueryBuilder $queryBuilder)
    {
        if (null !== $this->code && 0 !== $this->code) {
            $queryBuilder->andWhere('ems.codeEmployee = :codeEmployee');
            $queryBuilder->setParameter('codeEmployee', $this->code);
        }

        return $queryBuilder->expr()->eq('ems.codeEmployee', ':codeEmployee');
    }
}
