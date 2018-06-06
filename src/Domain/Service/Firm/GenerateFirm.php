<?php

namespace Inventory\Management\Domain\Service\Firm;

class GenerateFirm
{
    public function execute(string $data, string $password): string
    {
        openssl_sign($data, $firm, $password);

        return $firm;
    }
}
