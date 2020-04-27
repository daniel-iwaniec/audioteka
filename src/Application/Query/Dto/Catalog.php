<?php

declare(strict_types = 1);

namespace Audioteka\Application\Query\Dto;

use ArrayObject;

final class Catalog
{
    /** @var ArrayObject<int, Product> */
    public ArrayObject $products;

    public function __construct()
    {
        $this->products = new ArrayObject();
    }
}
