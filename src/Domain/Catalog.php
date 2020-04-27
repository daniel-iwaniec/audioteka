<?php

declare(strict_types = 1);

namespace Audioteka\Domain;

use Audioteka\Domain\Catalog\Product;
use Audioteka\Domain\Catalog\ProductCollection;

final class Catalog
{
    private ProductCollection $products;

    public function add(Product $product): void
    {
        $this->products->add($product);
    }
}
