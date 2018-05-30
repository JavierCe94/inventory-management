<?php

namespace Inventory\Management\Application\Employee\ChangeStatusToEnableEmployee;

use Assert\Assertion;

class ChangeStatusToEnableEmployeeCommand
{
    private const LENGTH_NIF = 9;

    private $nif;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($nif)
    {
        Assertion::notBlank($nif, 'Tienes que especificar tu NIF');
        Assertion::string($nif, 'El NIF tiene que ser de tipo texto');
        Assertion::length($nif, self::LENGTH_NIF, 'El NIF tiene que contener 9 carácteres');
        $this->nif = $nif;
    }

    public function nif(): string
    {
        return $this->nif;
    }
}
