<?php

namespace Inventory\Management\Application\Admin\CheckLoginAdmin;

use Assert\Assertion;

class CheckLoginAdminCommand
{
    private const LENGTH_USERNAME = 4;

    private $username;
    private $password;

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function __construct($username, $password)
    {
        Assertion::notBlank($username, 'Tienes que especificar tu nombre de usuario');
        Assertion::string($username, 'El nombre de usuario, tiene que ser de tipo texto');
        Assertion::minLength(
            $username,
            self::LENGTH_USERNAME,
            'El nombre de usuario, tiene que contener como mínimo 4 carácteres'
        );
        Assertion::notBlank($password, 'Tienes que especificar una contraseña');
        Assertion::string($password, 'La contraseña, tiene que ser de tipo texto');
        $this->username = $username;
        $this->password = $password;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function password(): string
    {
        return $this->password;
    }
}
