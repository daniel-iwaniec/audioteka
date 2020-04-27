<?php

declare(strict_types = 1);

namespace Audioteka\Application;

interface DaoLocator
{
    /**
     * @return mixed
     */
    public function get(string $name);
}
