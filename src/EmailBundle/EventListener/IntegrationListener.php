<?php

namespace KoalamonIntegration\EmailBundle\EventListener;

use Koalamon\Bundle\IntegrationBundle\EventListener\IntegrationInitEvent;
use Koalamon\Bundle\IntegrationBundle\Integration\Integration;
use Koalamon\Bundle\IntegrationBundle\Integration\IntegrationContainer;
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
        $integrationContainer->addIntegration(new Integration('Icinga', '', 'icinga ...', $url));
    }
}