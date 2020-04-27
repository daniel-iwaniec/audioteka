<?php

declare(strict_types = 1);

namespace Audioteka\Web\Responder;

use Audioteka\Application\Exception\Checked;
use Audioteka\Application\Exception\Query\EmptyCatalogPage;
use Audioteka\Application\Query\Dto\Catalog;
use Audioteka\Web\Responder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ShowCatalog implements Responder
{
    /**
     * @param Catalog|Checked $data
     */
    public function __invoke($data): JsonResponse
    {
        if ($data instanceof EmptyCatalogPage) {
            return new JsonResponse($data->getMessage(), Response::HTTP_NOT_FOUND);
        }

        if ($data instanceof Checked) {
            return new JsonResponse($data->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse($data);
    }
}
