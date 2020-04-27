<?php

declare(strict_types = 1);

namespace Audioteka\Application\Value;

use Audioteka\Application\Exception\Value\InvalidPagination;

final class Offset
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw InvalidPagination::invalidOffset($value);
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
