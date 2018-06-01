<?php

namespace Inventory\Management\Infrastructure\Util\Specification\Employee;

use Doctrine\ORM\QueryBuilder;
use Inventory\Management\Domain\Model\Specification\Specification;

class FilterEmployeeByName implements Specification
{
    private $name;

    public function __construct(?string $name)
    {
        $this->name = $name;
    }

    public function match(QueryBuilder $queryBuilder)
    {
        if (null !== $this->name && '' !== $this->name) {
            $queryBuilder->andWhere('em.name = :name');
            $queryBuilder->setParameter('name', $this->name);
        }

        return $queryBuilder->expr()->eq('em.name', ':name');
    }
}
