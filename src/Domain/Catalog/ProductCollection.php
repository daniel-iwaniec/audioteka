<?php

declare(strict_types = 1);

namespace Audioteka\Domain\Catalog;

use Countable;

interface ProductCollection extends Countable
{
    public function add(Product $product): void;
}
