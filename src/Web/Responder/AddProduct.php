<?php

declare(strict_types = 1);

namespace Audioteka\Web\Responder;

use Audioteka\Web\Responder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AddProduct implements Responder
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['success' => true]);
    }
}
