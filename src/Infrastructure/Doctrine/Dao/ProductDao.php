<?php

declare(strict_types = 1);

namespace Audioteka\Infrastructure\Doctrine\Dao;

use ArrayObject;
use Audioteka\Application\Dao\ProductDao as Port;
use Audioteka\Application\Data\Product;
use Audioteka\Application\Exception\Unchecked;
use Audioteka\Application\Value\Limit;
use Audioteka\Application\Value\Page;
use Doctrine\ORM\EntityRepository;
use Throwable;

final class ProductDao extends EntityRepository implements Port
{
    public function getPage(Page $page): ArrayObject
    {
        $data = $this
            ->createQueryBuilder('product')
            ->setFirstResult($page->offset(new Limit(self::LIMIT))->value())
            ->setMaxResults(self::LIMIT)
            ->getQuery()
            ->getResult();

        $catalog = new ArrayObject();
        foreach ($data as $datum) {
            $catalog->append($datum);
        }

        return $catalog;
    }

    public function save(Product ...$products): void
    {
        try {
            foreach ($products as $product) {
                $this->getEntityManager()->persist($product);
            }

            $this->getEntityManager()->flush($products);
        } catch (Throwable $exception) {
            throw Unchecked::wrap($exception);
        }
    }
}
