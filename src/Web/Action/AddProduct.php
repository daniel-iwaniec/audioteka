<?php

declare(strict_types = 1);

namespace Audioteka\Web\Action;

use Audioteka\Application\Command;
use Audioteka\Application\CommandBus;
use Audioteka\Web\Action;
use Symfony\Component\HttpFoundation\Request;

final class AddProduct implements Action
{
    public function __invoke(Request $request, CommandBus $commandBus): void
    {
        $commandBus->execute(new Command\AddProduct((string) $request->get('name'), (int) $request->get('price')));
    }
}
