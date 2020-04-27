<?php

declare(strict_types = 1);

namespace Audioteka\Application\Exception\Query;

use Audioteka\Application\Exception\Checked;
use Audioteka\Application\Value\Page;

class EmptyCatalogPage extends Checked
{
    public static function self(Page $page): self
    {
        throw new self("Page {$page->value()} is empty");
    }
}
