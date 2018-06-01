<?php

namespace Inventory\Management\Infrastructure\Util\Specification\RequestEmployee;

use Doctrine\ORM\QueryBuilder;
use Inventory\Management\Domain\Model\Specification\Specification;

class FilterRequestsEmployeeByState implements Specification
{
    private $status;

    public function __construct(?string $status)
    {
        $this->status = $status;
    }

    public function match(QueryBuilder $queryBuilder)
    {
        if (null !== $this->status && '' !== $this->status) {
            $queryBuilder->andWhere('re.status = :status');
            $queryBuilder->setParameter('status', $this->status);
        }

        return $queryBuilder->expr()->eq('re.status', ':status');
    }
}
