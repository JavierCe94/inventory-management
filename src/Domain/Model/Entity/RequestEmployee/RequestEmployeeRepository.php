<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

interface RequestEmployeeRepository
{
    public function createRequestEmployee(RequestEmployee $requestEmployee): RequestEmployee;
    public function changeStatusRequestEmployee(RequestEmployee $requestEmployee, string $status): RequestEmployee;
    public function findRequestEmployeeById(int $id): ?RequestEmployee;
    public function showRequestsEmployee(string $nif, ?string $status): array;
}
