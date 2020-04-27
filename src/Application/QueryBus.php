<?php

declare(strict_types = 1);

namespace Audioteka\Application;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class QueryBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    /**
     * @return mixed
     */
    public function execute(object $query)
    {
        return $this->handle($query);
    }
}
