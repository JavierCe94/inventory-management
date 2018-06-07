<?php

namespace Inventory\Management\Infrastructure\Util\CommandBus;

use Psr\Container\ContainerInterface;

class CommandBus
{
    /** @var ContainerInterface */
    private $handlerLocator;

    public function __construct(ContainerInterface $handlerLocator)
    {
        $this->handlerLocator = $handlerLocator;
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handle($command)
    {
        $commandClass = get_class($command);
        if (false === $this->handlerLocator->has($commandClass)) {
            return;
        }
        $handler = $this->handlerLocator->get($commandClass);

        return $handler->handle($command);
    }
}
