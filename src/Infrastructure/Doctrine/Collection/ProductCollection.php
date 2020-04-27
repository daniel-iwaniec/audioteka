<?php

declare(strict_types = 1);

namespace Audioteka\Infrastructure\Doctrine\Collection;

use Audioteka\Domain\Catalog\Product;
use Audioteka\Domain\Catalog\ProductCollection as Port;
use Audioteka\Infrastructure\Doctrine\Dao\ProductDao;

final class ProductCollection implements Port
{
    private ProductDao $productDao;

    /** @var array<int, Product> */
    private array $added;

    public function __construct(ProductDao $productDao)
    {
        $this->productDao = $productDao;
    }

    public function add(Product $product): void
    {
        $this->added[] = $product;
    }

    public function count(): int
    {
        return $this->productDao->count([]);
    }
}
