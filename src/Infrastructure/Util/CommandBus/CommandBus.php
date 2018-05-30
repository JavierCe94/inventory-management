<?php

namespace Inventory\Management\Infrastructure\Util\CommandBus;

use Inventory\Management\Application\Admin\CheckLoginAdmin\CheckLoginAdmin;
use Inventory\Management\Application\Admin\CheckLoginAdmin\CheckLoginAdminCommand;

class CommandBus
{
    private $handlers;
    private $checkLoginAdmin;

    public function __construct(
        CheckLoginAdmin $checkLoginAdmin
    ) {
        $this->checkLoginAdmin = $checkLoginAdmin;
        $this->listHandlers();
    }

    public function addHandler(string $commandName, $handler)
    {
        $this->handlers[$commandName] = $handler;
    }

    public function handle($command)
    {
        $commandHandler =  $this->handlers[get_class($command)];
        if (null === $commandHandler) {
            throw new \InvalidArgumentException();
        }

        return $commandHandler->handle($command);
    }

    private function listHandlers()
    {
        $this->addHandler(
            CheckLoginAdminCommand::class,
            $this->checkLoginAdmin
        );
    }
}
