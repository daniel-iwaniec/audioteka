<?php

declare(strict_types = 1);

namespace Audioteka\Application\Value;

use Audioteka\Application\Exception\Value\InvalidPagination;

final class Limit
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 1) {
            throw InvalidPagination::invalidLimit($value);
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
