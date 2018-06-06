<?php

namespace Inventory\Management\Domain\Model\Entity\RequestEmployee;

interface RequestEmployeeGarmentRepository
{
    public function createRequestEmployeeGarments(array $requestEmployeeGarments): array;
    public function changeStateRequestEmployeeGarment(
        RequestEmployeeGarment $requestEmployeeGarment,
        bool $isDeleted
    ): RequestEmployeeGarment;
    public function findRequestEmployeeGarmentById(int $idRequestGarment): ?RequestEmployeeGarment;
    public function checkRequestGarmentIsFromEmployee(
        string $nifEmployee,
        int $idRequestGarment
    ): ?RequestEmployeeGarment;
    public function showRequestEmployeeGarments(
        string $nifEmployee,
        int $idRequestEmployee,
        bool $showDeletes
    ): array;
}
