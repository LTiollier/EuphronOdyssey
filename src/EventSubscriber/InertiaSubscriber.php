<?php

namespace App\EventSubscriber;

use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class InertiaSubscriber implements EventSubscriberInterface
{
    protected InertiaInterface $inertia;

    public function __construct(InertiaInterface $inertia)
    {
        $this->inertia = $inertia;
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }

    public function onControllerEvent($event)
    {
        $this->inertia->share(
            'Auth::user',
            [
                'name' => 'Hannes',
                'posts' => function () {
                    return [1 => 'Post'];
                }
            ]
        );
    }
}