<?php

declare(strict_types = 1);

namespace Audioteka\Infrastructure\Doctrine;

use Audioteka\Application\DaoLocator as Port;
use Doctrine\ORM\EntityManagerInterface;

final class DaoLocator implements Port
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(string $name)
    {
        return $this->entityManager->getRepository($name);
    }
}
