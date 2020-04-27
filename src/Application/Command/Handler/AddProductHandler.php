<?php

declare(strict_types = 1);

namespace Audioteka\Application\Command\Handler;

use Audioteka\Application\Command\AddProduct;
use Audioteka\Domain\Catalog\Product;
use Audioteka\Domain\CatalogRepository;

final class AddProductHandler
{
    private CatalogRepository $catalogRepository;

    public function __construct(CatalogRepository $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    public function __invoke(AddProduct $command): void
    {
        $catalog = $this->catalogRepository->get();
        $catalog->add(new Product($command->name(), $command->price()));
    }
}
