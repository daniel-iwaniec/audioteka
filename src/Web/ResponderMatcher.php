<?php

declare(strict_types = 1);

namespace Audioteka\Web;

use Audioteka\Application\Exception\Checked;
use Audioteka\Application\Exception\Unchecked;
use Generator;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class ResponderMatcher implements EventSubscriberInterface
{
    private ContainerInterface $webResponders;

    private ?Responder $responder = null;

    public function __construct(ContainerInterface $webResponders)
    {
        $this->webResponders = $webResponders;
    }

    /**
     * @return Generator<string, string>
     */
    public static function getSubscribedEvents(): Generator
    {
        yield KernelEvents::CONTROLLER => 'createResponder';
        yield KernelEvents::VIEW => 'createResponse';
        yield KernelEvents::EXCEPTION => 'createExceptionResponse';
    }

    public function createResponder(ControllerEvent $event): void
    {
        if (!$event->getController() instanceof Action) {
            return;
        }

        try {
            $name = Responder::class . '\\' . (new ReflectionClass($event->getController()))->getShortName();
            $this->responder = $this->webResponders->get($name);
        } catch (ReflectionException $exception) {
            throw Unchecked::wrap($exception);
        }
    }

    public function createResponse(ViewEvent $event): void
    {
        if (!is_callable($this->responder)) {
            return;
        }

        $event->setResponse(($this->responder)($event->getControllerResult()));
    }

    public function createExceptionResponse(ExceptionEvent $event): void
    {
        if (!is_callable($this->responder)) {
            return;
        }

        if (!$event->getThrowable() instanceof HandlerFailedException) {
            return;
        }

        if (!$event->getThrowable()->getPrevious() instanceof Checked) {
            return;
        }

        $event->setResponse(($this->responder)($event->getThrowable()->getPrevious()));
    }
}
