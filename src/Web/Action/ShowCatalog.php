<?php

declare(strict_types = 1);

namespace Audioteka\Web\Action;

use Audioteka\Application\Query;
use Audioteka\Application\Query\Dto\Catalog;
use Audioteka\Application\QueryBus;
use Audioteka\Web\Action;
use Symfony\Component\HttpFoundation\Request;

final class ShowCatalog implements Action
{
    public function __invoke(Request $request, QueryBus $queryBus): Catalog
    {
        return $queryBus->execute(new Query\ShowCatalog((int) $request->get('page', 1)));
    }
}
