<?php

namespace App\EventSubscriber;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

class KernelRequestSubscriber implements EventSubscriberInterface
{
    private bool $isMaintenance;

    public function __construct(
        protected readonly Environment $twig,
        #[Autowire('%env(bool:APP_MAINTENANCE)%')]
        bool $isMaintenance
    ) {
        $this->isMaintenance = $isMaintenance;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if ($this->isMaintenance && $event->getRequestType() === KernelInterface::MAIN_REQUEST) {
            $response = new Response($this->twig->render('includes/_maintenance.html.twig'));
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 9999],
        ];
    }
}
