<?php

declare(strict_types = 1);

namespace Audioteka\Application\Exception;

use RuntimeException;
use Throwable;

class Unchecked extends RuntimeException
{
    final public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function wrap(Throwable $exception): self
    {
        if ($exception instanceof static) {
            return $exception;
        }

        return new static($exception->getMessage(), $exception->getCode(), $exception);
    }
}
