<?php

declare(strict_types = 1);

namespace Audioteka\Application\Query\Handler;

use Audioteka\Application\Dao\ProductDao;
use Audioteka\Application\DaoLocator;
use Audioteka\Application\Data;
use Audioteka\Application\Exception\Query\EmptyCatalogPage;
use Audioteka\Application\Query\Dto\Catalog;
use Audioteka\Application\Query\Dto\Product;
use Audioteka\Application\Query\ShowCatalog;

final class ShowCatalogHandler
{
    private ProductDao $productDao;

    public function __construct(DaoLocator $daoLocator)
    {
        $this->productDao = $daoLocator->get(Data\Product::class);
    }

    /**
     * @throws EmptyCatalogPage
     */
    public function __invoke(ShowCatalog $query): Catalog
    {
        $catalog = new Catalog();
        foreach ($this->productDao->getPage($query->page()) as $product) {
            $dto = new Product();
            $dto->name = $product->name;
            $dto->price = number_format($product->price / 100, 2, '.', '');

            $catalog->products->append($dto);
        }

        if ($catalog->products->count() === 0) {
            throw EmptyCatalogPage::self($query->page());
        }

        return $catalog;
    }
}
