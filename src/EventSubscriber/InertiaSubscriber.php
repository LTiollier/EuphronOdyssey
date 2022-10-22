<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class InertiaSubscriber implements EventSubscriberInterface
{
    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
    }
}