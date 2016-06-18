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
        $integrationContainer->addIntegration(new Integration('Monitis', '/bundles/koalamonintegrationwebhook/images/monitis.png', 'All-in-one application monitoring platform.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'webhook']);
        $integrationContainer->addIntegration(new Integration('Webhook', '/images/integrations/webhook.png', 'Simple webhook for default integrations.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'appDynamics']);
        $integrationContainer->addIntegration(new Integration('AppDynamics', '/images/integrations/appdynamics.png', 'The next generation of Application Intelligence has arrived', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'jira']);
        $integrationContainer->addIntegration(new Integration('Jira', '/images/integrations/jira-logo-01.png', 'Your favourite issue tracker.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'leankoala']);
        $integrationContainer->addIntegration(new Integration('www.leankoala.com', '/images/integrations/leankoala.png', 'Koalamons little brother.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'travis']);
        $integrationContainer->addIntegration(new Integration('Travis CI', '/bundles/koalamonintegrationwebhook/images/travis.png', 'Easily sync your projects with Travis CI. Testing your code in minutes!', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'jenkins']);
        $integrationContainer->addIntegration(new Integration('Jenkins', '/bundles/koalamonintegrationwebhook/images/jenkins.png', 'Build great things at any scale', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'koalaception']);
        $integrationContainer->addIntegration(new Integration('Codeception', '/bundles/koalamonintegrationwebhook/images/codeception.png', 'Modern PHP testing for everyone.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'xunit']);
        $integrationContainer->addIntegration(new Integration('xUnit', '/bundles/koalamonintegrationwebhook/images/xunit.png', 'Sending every xunit files to koalamon.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'scrutinizer']);
        $integrationContainer->addIntegration(new Integration('Scrutinizer', '/bundles/koalamonintegrationwebhook/images/scrutinizer.png', 'Continuously measure and track your code quality.', $url));

        $url = $this->router->generate('koalamonintegration_webhook', ['project' => $event->getProject()->getIdentifier(), 'hookName' => 'pingdom']);
        $integrationContainer->addIntegration(new Integration('Pingdom', '/bundles/koalamonintegrationwebhook/images/pingdom.png', 'Web performance management.', $url));

    }
}