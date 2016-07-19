<?php

namespace KoalamonIntegration\EmailBundle\EventListener;

use Koalamon\IntegrationBundle\EventListener\IntegrationInitEvent;
use Koalamon\IntegrationBundle\Integration\Integration;
use Symfony\Component\DependencyInjection\Container;

class IntegrationListener
{
    private $router;

    public function __construct(Container $container)
    {
        $this->router = $container->get('router');
    }

    public function onInit(IntegrationInitEvent $event)
    {
        $integrationContainer = $event->getIntegrationContainer();

        $url = $this->router->generate('koalamonintegration_email', ['project' => $event->getProject()->getIdentifier(), 'integrationName' => 'icinga']);
        $integrationContainer->addIntegration(new Integration('Icinga', '/bundles/koalamonintegrationemail/images/icinga.png', 'Icinga is a scalable and extensible monitoring system.', $url));
    }
}