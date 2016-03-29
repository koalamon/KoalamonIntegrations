<?php

namespace KoalamonIntegration\WebhookBundle\EventListener;

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

    private function initIntegrations(IntegrationContainer $container)
    {

    }

    public function onInit(IntegrationInitEvent $event)
    {
        $integrationContainer = $event->getIntegrationContainer();

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'newRelic']);
        $integrationContainer->addIntegration(new Integration('NewRelic', '/images/integrations/newrelic.png', 'Software Analytics with real-time data to bring it all together.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'monitis']);
        $integrationContainer->addIntegration(new Integration('Monitis', '/images/integrations/monitis.png', 'All-in-one application monitoring platform.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'webhook']);
        $integrationContainer->addIntegration(new Integration('Webhook', '/images/integrations/webhook.png', 'Simple webhook for default integrations.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'appDynamics']);
        $integrationContainer->addIntegration(new Integration('AppDynamics', '/images/integrations/appdynamics.png', 'The next generation of Application Intelligence has arrived', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'jira']);
        $integrationContainer->addIntegration(new Integration('Jira', '/images/integrations/jira-logo-01.png', 'Your favourite issue tracker.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'leankoala']);
        $integrationContainer->addIntegration(new Integration('www.leankoala.com', '/images/integrations/leankoala.png', 'Koalamons little brother.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'travis']);
        $integrationContainer->addIntegration(new Integration('Travis CI', '/bundles/koalamonintegrationwebhook/images/travis.png', 'Easily sync your projects with Travis CI. Testing your code in minutes!.', $url));

    }
}