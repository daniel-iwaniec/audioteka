<?php

declare(strict_types = 1);

namespace Audioteka\Domain;

interface CatalogRepository
{
    public function get(): Catalog;
}
