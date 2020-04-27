<?php

declare(strict_types = 1);

namespace Audioteka\Infrastructure\Doctrine\Repository;

use Audioteka\Application\Data\Product;
use Audioteka\Application\UnitOfWork;
use Audioteka\Domain\Catalog;
use Audioteka\Domain\CatalogRepository as Port;
use Audioteka\Infrastructure\Doctrine\Collection\ProductCollection;
use Audioteka\Infrastructure\Doctrine\Dao\ProductDao;
use Audioteka\Infrastructure\Doctrine\DaoLocator;

final class CatalogRepository implements Port
{
    private UnitOfWork $unitOfWork;

    private ProductDao $productDao;

    public function __construct(UnitOfWork $unitOfWork, DaoLocator $daoLocator)
    {
        $this->unitOfWork = $unitOfWork;
        $this->productDao = $daoLocator->get(Product::class);
    }

    public function get(): Catalog
    {
        $catalog = adm(Catalog::class)->products(new ProductCollection($this->productDao))();

        $this->unitOfWork->persist(function () use ($catalog) {
            $this->persist($catalog);
        });

        return $catalog;
    }

    private function persist(Catalog $catalog): void
    {
        $products = [];
        foreach (adm(adm($catalog)->products())->added() as $newProduct) {
            $product = new Product();
            $product->name = adm(adm($newProduct)->name())->name();
            $product->price = adm(adm($newProduct)->price())->price();
            $products[] = $product;
        }

        $this->productDao->save(...$products);
    }
}
