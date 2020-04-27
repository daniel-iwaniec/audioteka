<?php

declare(strict_types = 1);

namespace Audioteka\Domain\Catalog;

use Audioteka\Domain\Catalog\Product\Id;
use Audioteka\Domain\Catalog\Product\Name;
use Audioteka\Domain\Catalog\Product\Price;

final class Product
{
    private Id $id;

    private Name $name;

    private Price $price;

    public function __construct(Name $name, Price $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}
