<?php

declare(strict_types = 1);

namespace Audioteka\Application;

use Closure;

final class UnitOfWork
{
    /** @var array<int, Closure> */
    private array $closures = [];

    public function persist(Closure $closure): void
    {
        $this->closures[] = $closure;
    }

    public function flush(): void
    {
        foreach ($this->closures as $closure) {
            $closure();
        }
    }
}
