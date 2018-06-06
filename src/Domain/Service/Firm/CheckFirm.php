<?php

namespace Inventory\Management\Domain\Service\Firm;

class CheckFirm
{
    public function execute(string $data, string $signature, string $password)
    {
        openssl_verify($data, $signature, $password);
    }
}
