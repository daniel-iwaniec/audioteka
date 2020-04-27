<?php

declare(strict_types = 1);

namespace Audioteka\Application\Dao;

use ArrayObject;
use Audioteka\Application\Data\Product;
use Audioteka\Application\Value\Page;

interface ProductDao
{
    public const LIMIT = 3;

    /**
     * @return ArrayObject<int, Product>
     */
    public function getPage(Page $page): ArrayObject;

    public function save(Product ...$products): void;
}
