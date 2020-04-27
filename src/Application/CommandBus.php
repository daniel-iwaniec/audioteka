<?php

declare(strict_types = 1);

namespace Audioteka\Application;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->messageBus = $commandBus;
    }

    public function execute(object $command): void
    {
        $this->handle($command);
    }
}
